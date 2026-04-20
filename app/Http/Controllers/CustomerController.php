<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\SurveyBooking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;
use App\Models\OrderTracking;
use App\Models\OrderTrackingStep;
use Illuminate\Support\Collection;

use Throwable;

class CustomerController extends Controller
{
    protected Client $twilio;
    protected string $verifySid;

    public function __construct()
    {
        $this->twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $this->verifySid = config('services.twilio.verify_sid');
    }

    public function welcome(){
        return view('welcome');
    }

    public function sendOtp(Request $request)
    {
        try {
            $request->validate([
                'mobile' => ['required', 'digits:10'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $mobile = '+91' . $request->mobile;

        try {
            $verification = $this->twilio->verify->v2
                ->services($this->verifySid)
                ->verifications
                ->create($mobile, 'sms');

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully.',
                'verification_status' => $verification->status,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


 
public function verifyOtp(Request $request)
{
    try {
        $request->validate([
            'mobile' => ['required', 'digits:10'],
            'otp' => ['required', 'digits_between:4,10'],
            'redirect_url' => ['nullable', 'string'],
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => false,
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    }

    $mobile = '+91' . $request->mobile;

    try {
        $check = $this->twilio->verify->v2
            ->services($this->verifySid)
            ->verificationChecks
            ->create([
                'to' => $mobile,
                'code' => $request->otp,
            ]);

        if ($check->status !== 'approved') {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP.',
            ], 422);
        }

        $customer = \App\Models\Customer::firstOrCreate(
            ['mobile' => $request->mobile],
            [
                'name' => null,
                'email' => null,
            ]
        );

        session([
            'customer_id' => $customer->id,
            'customer_name' => $customer->name ?: 'User',
            'customer_mobile' => $customer->mobile,
            'customer_logged_in' => true,
        ]);

        /* ================================
           SAVE PENDING POST AFTER OTP
        ================================= */
        $postSaved = false;

        if (session()->has('pending_post')) {
            $pendingPost = session('pending_post');
            $pendingFiles = session('pending_post_files', []);

            $data = [
                'user_id'         => $customer->id,
                'title'           => $pendingPost['title'] ?? null,
                'work_type_id'    => $pendingPost['work_type_id'] ?? null,
                'work_subtype_id' => $pendingPost['work_subtype_id'] ?? null,
              
                'city'            => $pendingPost['city'] ?? null,
                'pincode'         => $pendingPost['pincode'] ?? null,
                'budget_id'       => $pendingPost['budget'] ?? null,
                'contact_name'    => $pendingPost['contact_name'] ?? null,
                'mobile'          => $pendingPost['mobile'] ?? $customer->mobile,
                'email'           => $pendingPost['email'] ?? null,
                'description'     => $pendingPost['description'] ?? null,
                'area'            => $pendingPost['area'] ?? null,
                'unit_id'         => $pendingPost['unit'] ?? null,
                'post_verify'     => 0,
                'get_vendor'      => 0,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];

            if (!empty($pendingFiles)) {
                $finalFiles = [];

                $tempPath = public_path('uploads/temp_posts');
                $finalPath = public_path('uploads/posts');

                if (!file_exists($finalPath)) {
                    mkdir($finalPath, 0777, true);
                }

                foreach ($pendingFiles as $file) {
                    if (file_exists($tempPath . '/' . $file)) {
                        rename($tempPath . '/' . $file, $finalPath . '/' . $file);
                        $finalFiles[] = $file;
                    }
                }

                if (!empty($finalFiles)) {
                    $data['files'] = json_encode($finalFiles);
                }
            }

            \DB::table('posts')->insert($data);

            session()->forget('pending_post');
            session()->forget('pending_post_files');

            $postSaved = true;
        }

        return response()->json([
            'status' => true,
            'message' => $postSaved ? 'OTP verified and project submitted successfully.' : 'Login successful.',
            'post_saved' => $postSaved,
            'customer_name' => $customer->name ?: 'User',
            'customer_mobile' => $customer->mobile,
            'reload' => true,
            'redirect' => $request->redirect_url ?: route('customer.survey'),
        ]);

    } catch (\Throwable $e) {
        return response()->json([
            'status' => false,
            'message' => 'OTP verification failed.',
            'error' => $e->getMessage(),
        ], 500);
    }
}
    public function surveyPage()
    {
        return view('customer.survey');
    }


    public function saveSurveyBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name'  => ['required', 'string', 'max:255'],
            'package_name'  => ['required', 'string', 'max:255'],
            'full_name'     => ['required', 'string', 'max:255'],
            'mobile'        => ['required', 'digits:10'],
            'email'         => ['nullable', 'email', 'max:255'],
            // 'full_address'  => ['required', 'string'],
            'land_area'     => ['nullable', 'string', 'max:255'],
            'area_unit'     => ['nullable', 'string', 'max:50'],
            'description'   => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $customerId = session('customer_id');

        $booking = SurveyBooking::create([
            'customer_id'   => $customerId,
            'service_name'  => $request->service_name,
            'package_name'  => $request->package_name,
            'full_name'     => $request->full_name,
            'mobile'        => $request->mobile,
            'email'         => $request->email,
            'city'          => $request->city,
            'pincode'       => $request->pincode,
            'land_area'     => $request->land_area,
            'area_unit'     => $request->area_unit,
            'description'   => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Survey booking submitted successfully.',
            'booking_id' => $booking->id,
            'redirect' => route('customer.survey'),
        ]);
    }



    public function testingPage(){
        return view('customer.testing');
    }

    public function boqPage(){
        return view('customer.boq');

    }

    public function facadePage(){
        return view('customer.facade');
    }

    public function structuralaudit(){
        return view('customer.structuralaudit');
    }


    public function nasupport(){
        return view('customer.nasupport');
    }

    public function welding_fabrication(){
        return view('customer.welding-fabrication');
    }

   
    public function post(Request $request)
    {
        $work_types   = DB::table('work_types')->get();
        $states       = DB::table('state')->orderBy('name')->get();
        $budget_range = DB::table('budget_range')->get();
        $unit         = DB::table('cust_unit')->get();

        $selectedWorkTypeId = $request->work_type_id;

        return view('customer.post', compact(
            'work_types',
            'states',
            'budget_range',
            'unit',
            'selectedWorkTypeId'
        ));
    }
        
    public function savepost(Request $request)
    {
        $customer_id = session('customer_id');

        $request->validate([
            'title'           => 'required|string|max:255',
            'work_type_id'    => 'required|integer',
            'work_subtype_id' => 'required|integer',
            'city'            => 'required|string|max:255',
            'budget'          => 'required',
            'contact_name'    => 'required|string|max:255',
            'mobile'          => 'required|string|max:20',
            'email'           => 'required|email|max:255',
            'description'     => 'required|string',
            'area'            => 'required|string|max:255',
            'unit'            => 'nullable',
            'pincode'         => 'nullable|string|max:20',
        ]);

        /*
        |--------------------------------------------------------------------------
        | If customer not logged in -> store post in session and ask OTP
        |--------------------------------------------------------------------------
        */
        if (!$customer_id) {

            Session::put('pending_post', $request->except(['_token', 'files']));

            $tempFiles = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $destination = public_path('uploads/temp_posts');
                    if (!file_exists($destination)) {
                        mkdir($destination, 0777, true);
                    }

                    $file->move($destination, $name);
                    $tempFiles[] = $name;
                }
            }

            Session::put('pending_post_files', $tempFiles);

            return response()->json([
                'status'  => 'otp_required',
                'message' => 'Please verify your mobile number with OTP.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Post limit check
        |--------------------------------------------------------------------------
        */
        $postCount = DB::table('posts')
            ->where('user_id', $customer_id)
            ->count();

        if ($postCount >= 3) {
            return response()->json([
                'status'  => 'payment_required',
                'message' => 'You have reached your free post limit.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Prepare post data
        |--------------------------------------------------------------------------
        */
        $data = [
            'user_id'         => $customer_id,
            'title'           => $request->title,
            'work_type_id'    => $request->work_type_id,
            'work_subtype_id' => $request->work_subtype_id,
        
            'city'            => $request->city,
            'pincode'         => $request->pincode,
            'budget_id'       => $request->budget,
            'contact_name'    => $request->contact_name,
            'mobile'          => $request->mobile,
            'email'           => $request->email,
            'description'     => $request->description,
            'area'            => $request->area,
            'unit_id'         => $request->unit,
            'post_verify'     => 0,
            'get_vendor'      => 0,
            'created_at'      => now(),
            'updated_at'      => now(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Upload files
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('files')) {
            $fileNames = [];

            foreach ($request->file('files') as $file) {
                $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $destination = public_path('uploads/posts');
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $name);
                $fileNames[] = $name;
            }

            $data['files'] = json_encode($fileNames);
        }

        DB::table('posts')->insert($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Project Posted Successfully',
        ]);
    }
    public function getProjectTypes($workTypeId)
    {
         $subtypes = DB::table('work_subtypes')
                    ->where('work_type_id', $workTypeId)
                    ->get();
        return response()->json($subtypes);
    }

 
// public function myorder()
// {
//     $customerId = session('customer_id');

//     if (!$customerId) {
//         return redirect()->back()->with('error', 'Customer session not found.');
//     }

//     // Survey Bookings
//     $surveyBookings = DB::table('survey_bookings')
//         ->where('customer_id', $customerId)
//         ->get()
//         ->map(function ($item) {
//             return (object) [
//                 'id' => $item->id,
//                 'type' => 'Survey Booking',
//                 'service_key' => 'survey',
//                 'service_name' => $item->service_name ?? 'Survey Service',
//                 'title' => $item->service_name ?? 'Survey Service',
//                 'location' => $item->full_address ?? '-',
//                 'scope' => trim(($item->land_area ?? '-') . ' ' . ($item->area_unit ?? '')),
//                 'description' => $item->description ?? '-',
//                 'created_at' => $item->created_at,
//                 'raw_data' => $item,
//             ];
//         });

//     // Testing Enquiries
//     $testingEnquiries = DB::table('testing_enquiries')
//         ->where('customer_id', $customerId)
//         ->get()
//         ->map(function ($item) {
//             $location = collect([
//                 $item->house_building_name ?? null,
//                 $item->road_area_colony ?? null,
//                 $item->city ?? null,
//                 $item->pincode ?? null,
//             ])->filter()->implode(', ');

//             return (object) [
//                 'id' => $item->id,
//                 'type' => 'Testing Enquiry',
//                 'service_key' => 'testing',
//                 'service_name' => $item->service_name ?? 'Testing Service',
//                 'title' => $item->project_name ?? $item->service_name ?? 'Testing Service',
//                 'location' => $location ?: '-',
//                 'scope' => $item->required_testing_type ?? '-',
//                 'description' => $item->additional_details ?? '-',
//                 'created_at' => $item->created_at,
//                 'raw_data' => $item,
//             ];
//         });

//     // BOQ Enquiries
//     $boqEnquiries = DB::table('boq_enquiries')
//         ->where('customer_id', $customerId)
//         ->get()
//         ->map(function ($item) {
//             $location = collect([
//                 $item->house_building_name ?? null,
//                 $item->road_area_colony ?? null,
//                 $item->city ?? null,
//                 $item->pincode ?? null,
//             ])->filter()->implode(', ');

//             return (object) [
//                 'id' => $item->id,
//                 'type' => 'BOQ Enquiry',
//                 'service_key' => 'boq',
//                 'service_name' => $item->service_name ?? 'BOQ / Estimation',
//                 'title' => $item->project_name ?? $item->service_name ?? 'BOQ / Estimation',
//                 'location' => $location ?: '-',
//                 'scope' => $item->project_type ?? '-',
//                 'description' => $item->additional_details ?? '-',
//                 'created_at' => $item->created_at,
//                 'raw_data' => $item,
//             ];
//         });

//     // Example: Contractor Bookings
//     $contractorBookings = DB::table('contractor_providers')
//         ->where('customer_id', $customerId)
//         ->get()
//         ->map(function ($item) {
//             $location = collect([
//                 $item->house_building_name ?? null,
//                 $item->road_area_colony ?? null,
//                 $item->city ?? null,
//                 $item->pincode ?? null,
//             ])->filter()->implode(', ');

//             return (object) [
//                 'id' => $item->id,
//                 'type' => 'Contractor Booking',
//                 'service_key' => 'contractor',
//                 'service_name' => $item->service_name ?? 'Contractor Service',
//                 'title' => $item->project_name ?? $item->service_name ?? 'Contractor Service',
//                 'location' => $location ?: '-',
//                 'scope' => $item->project_type ?? '-',
//                 'description' => $item->additional_details ?? '-',
//                 'created_at' => $item->created_at,
//                 'raw_data' => $item,
//             ];
//         });

//     // Example: Interior Bookings
//     $interiorBookings = DB::table('interior_providers')
//         ->where('customer_id', $customerId)
//         ->get()
//         ->map(function ($item) {
//             $location = collect([
//                 $item->house_building_name ?? null,
//                 $item->road_area_colony ?? null,
//                 $item->city ?? null,
//                 $item->pincode ?? null,
//             ])->filter()->implode(', ');

//             return (object) [
//                 'id' => $item->id,
//                 'type' => 'Interior Booking',
//                 'service_key' => 'interior',
//                 'service_name' => $item->service_name ?? 'Interior Service',
//                 'title' => $item->project_name ?? $item->service_name ?? 'Interior Service',
//                 'location' => $location ?: '-',
//                 'scope' => $item->project_type ?? '-',
//                 'description' => $item->additional_details ?? '-',
//                 'created_at' => $item->created_at,
//                 'raw_data' => $item,
//             ];
//         });

//     $allOrders = collect()
//         ->concat($surveyBookings)
//         ->concat($testingEnquiries)
//         ->concat($boqEnquiries)
//         ->concat($contractorBookings)
//         ->concat($interiorBookings)
//         ->sortByDesc('created_at')
//         ->values();

//     return view('customer.myorder', compact('allOrders'));
// }


 public function myorder()
    {
        $customerId = session('customer_id');

        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer session not found.');
        }

        $surveyBookings = DB::table('survey_bookings')
            ->where('customer_id', $customerId)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'type' => 'Survey Booking',
                    'service_key' => 'survey',
                    'service_name' => $item->service_name ?? 'Survey Service',
                    'title' => $item->service_name ?? 'Survey Service',
                    'location' => $item->full_address ?? '-',
                    'scope' => trim(($item->land_area ?? '-') . ' ' . ($item->area_unit ?? '')),
                    'description' => $item->description ?? '-',
                    'created_at' => $item->created_at,
                    'raw_data' => $item,
                ];
            });

        $testingEnquiries = DB::table('testing_enquiries')
            ->where('customer_id', $customerId)
            ->get()
            ->map(function ($item) {
                $location = collect([
                    $item->house_building_name ?? null,
                    $item->road_area_colony ?? null,
                    $item->city ?? null,
                    $item->pincode ?? null,
                ])->filter()->implode(', ');

                return (object) [
                    'id' => $item->id,
                    'type' => 'Testing Enquiry',
                    'service_key' => 'testing',
                    'service_name' => $item->service_name ?? 'Testing Service',
                    'title' => $item->project_name ?? $item->service_name ?? 'Testing Service',
                    'location' => $location ?: '-',
                    'scope' => $item->required_testing_type ?? '-',
                    'description' => $item->additional_details ?? '-',
                    'created_at' => $item->created_at,
                    'raw_data' => $item,
                ];
            });

        $boqEnquiries = DB::table('boq_enquiries')
            ->where('customer_id', $customerId)
            ->get()
            ->map(function ($item) {
                $location = collect([
                    $item->house_building_name ?? null,
                    $item->road_area_colony ?? null,
                    $item->city ?? null,
                    $item->pincode ?? null,
                ])->filter()->implode(', ');

                return (object) [
                    'id' => $item->id,
                    'type' => 'BOQ Enquiry',
                    'service_key' => 'boq',
                    'service_name' => $item->service_name ?? 'BOQ / Estimation',
                    'title' => $item->project_name ?? $item->service_name ?? 'BOQ / Estimation',
                    'location' => $location ?: '-',
                    'scope' => $item->project_type ?? '-',
                    'description' => $item->additional_details ?? '-',
                    'created_at' => $item->created_at,
                    'raw_data' => $item,
                ];
            });

        $contractorBookings = DB::table('contractor_providers')
            ->where('customer_id', $customerId)
            ->get()
            ->map(function ($item) {
                $location = collect([
                    $item->house_building_name ?? null,
                    $item->road_area_colony ?? null,
                    $item->city ?? null,
                    $item->pincode ?? null,
                ])->filter()->implode(', ');

                return (object) [
                    'id' => $item->id,
                    'type' => 'Contractor Booking',
                    'service_key' => 'contractor',
                    'service_name' => $item->service_name ?? 'Contractor Service',
                    'title' => $item->project_name ?? $item->service_name ?? 'Contractor Service',
                    'location' => $location ?: '-',
                    'scope' => $item->project_type ?? '-',
                    'description' => $item->additional_details ?? '-',
                    'created_at' => $item->created_at,
                    'raw_data' => $item,
                ];
            });

        $interiorBookings = DB::table('interior_providers')
            ->where('customer_id', $customerId)
            ->get()
            ->map(function ($item) {
                $location = collect([
                    $item->house_building_name ?? null,
                    $item->road_area_colony ?? null,
                    $item->city ?? null,
                    $item->pincode ?? null,
                ])->filter()->implode(', ');

                return (object) [
                    'id' => $item->id,
                    'type' => 'Interior Booking',
                    'service_key' => 'interior',
                    'service_name' => $item->service_name ?? 'Interior Service',
                    'title' => $item->project_name ?? $item->service_name ?? 'Interior Service',
                    'location' => $location ?: '-',
                    'scope' => $item->project_type ?? '-',
                    'description' => $item->additional_details ?? '-',
                    'created_at' => $item->created_at,
                    'raw_data' => $item,
                ];
            });

        $allOrders = collect()
            ->concat($surveyBookings)
            ->concat($testingEnquiries)
            ->concat($boqEnquiries)
            ->concat($contractorBookings)
            ->concat($interiorBookings)
            ->sortByDesc('created_at')
            ->values();

        return view('customer.myorder', compact('allOrders'));
    }

    public function track($service_key, $source_id)
    {
        $tracking = OrderTracking::where('service_key', $service_key)
            ->where('source_id', $source_id)
            ->first();

        if (!$tracking) {
            return redirect()->back()->with('error', 'Tracking template not assigned by admin yet.');
        }

        $trackingSteps = OrderTrackingStep::where('order_tracking_id', $tracking->id)
            ->orderBy('tab_type')
            ->orderBy('step_order')
            ->get();

        return view('customer.order_track', compact('tracking', 'trackingSteps'));
    }
  
public function orderTrack($service, $id)
{
    // dd($id);
    $orderSteps = DB::table('tracking_templates')
        ->where('service_key', $service)
        ->where('tab_type', 'order')
        ->orderBy('step_order')
        ->get();

    $executionSteps = DB::table('tracking_templates')
        ->where('service_key', $service)
        ->where('tab_type', 'execution')
        ->orderBy('step_order')
        ->get();

    return view('customer.dynamic-order-track', compact(
        'service',
        'id',
        'orderSteps',
        'executionSteps'
    ));
}
        
    public function logout()
    {
        session()->forget([
            'customer_id',
            'customer_name',
            'customer_mobile',
            'customer_logged_in',
        ]);

        return redirect('/')->with('success', 'Logged out successfully.');
    }



}