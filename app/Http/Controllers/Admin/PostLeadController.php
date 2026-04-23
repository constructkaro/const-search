<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class PostLeadController extends Controller
{



    public function index(Request $request)
    {
        $query = DB::table('posts')
            ->leftJoin('city', 'posts.city_id', '=', 'city.id')
            ->select('posts.*', 'city.name as city_name')
            ->latest('posts.created_at');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('posts.title', 'like', '%' . $search . '%')
                ->orWhere('posts.contact_name', 'like', '%' . $search . '%')
                ->orWhere('posts.mobile', 'like', '%' . $search . '%')
                ->orWhere('city.name', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->paginate(10)->appends([
            'search' => $request->search
        ]);

        if ($request->ajax()) {
            return view('admin.project.partials.project_table', compact('posts'))->render();
        }
        // dd($posts);
        return view('admin.project.allprojects', compact('posts'));
    }

    public function create()
    {
        $work_types   = DB::table('work_types')->get();
        $states       = DB::table('state')->orderBy('name')->get();
        $budget_range = DB::table('budget_range')->get();
        $unit         = DB::table('cust_unit')->get();
        $cities = DB::table('city')->orderBy('name', 'asc')->get();

        return view('admin.project.create', compact('work_types','states','budget_range','unit','cities'));
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title'           => 'required|string|max:255',
        'contact_name'    => 'required|string|max:255',
        'mobile'          => 'required|string|max:20',
        'email'           => 'nullable|email|max:255',
        'state'           => 'nullable|string|max:255',
        'lead_status'     => 'nullable|in:timepass,exploring,serious',
        'city_id'         => 'nullable|string',
        'area_ids'        => 'nullable|array',   // ✅ nullable so it doesn't fail if empty
        'area_ids.*'      => 'integer',           // ✅ each item must be integer
        'pincode'         => 'nullable|string',
        'description'     => 'nullable|string',
        'contact_time'    => 'nullable|string|max:250',
        'work_type_id'    => 'nullable|integer',
        'work_subtype_id' => 'nullable|integer',
        'budget_id'       => 'nullable|integer',
        'unit_id'         => 'nullable|integer',
        'files'           => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        'add_by'          => 'nullable|string',
    ]);

    if ($validator->fails()) {
        if ($request->ajax()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // ✅ Fix 1: Convert area_ids array → JSON string for DB storage
    $areaIds = $request->area_ids ?? [];
    $areaIdsJson = json_encode($areaIds); // stores as: [1, 2, 3]

    // ✅ Fix 2: Handle pincode — it comes as a comma-separated string from readonly input
    // Just store it as-is (it's already a string like "400701, 400705")
    $pincode = $request->pincode ?? null;

    // ✅ Fix 3: Handle file upload (supports multiple files)
    $filePath = null;
    if ($request->hasFile('files')) {
        $uploadedFiles = $request->file('files');

        // If multiple files, store all paths as JSON
        if (is_array($uploadedFiles)) {
            $paths = [];
            foreach ($uploadedFiles as $file) {
                $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $paths[]  = $file->storeAs('post_files', $fileName, 'public');
            }
            $filePath = json_encode($paths);
        } else {
            // Single file
            $file      = $uploadedFiles;
            $fileName  = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $filePath  = $file->storeAs('post_files', $fileName, 'public');
        }
    }

    $insertId = DB::table('posts')->insertGetId([
        'user_id'         => 0,
        'title'           => $request->title,
        'work_subtype_id' => $request->work_subtype_id ?: null,
        'work_type_id'    => $request->work_type_id    ?: null,
        'area_ids'        => $areaIdsJson,              // ✅ Fixed: JSON string not array
        'city_id'         => $request->city_id,
        'budget_id'       => $request->budget          ?: null,
        'contact_name'    => $request->contact_name,
        'mobile'          => $request->mobile,
        'email'           => $request->email,
        'add_by'          => $request->add_by,
        'lead_status'     => $request->lead_status,
        'description'     => $request->description,
        'files'           => $filePath,
        'contact_time'    => $request->contact_time,
        'post_verify'     => 0,
        'get_vendor'      => 0,
        'pincode'         => $pincode,                  // ✅ Already a string from the readonly input
        'unit_id'         => $request->unit            ?: null,
        'created_at'      => now(),
        'updated_at'      => now(),
    ]);

    if ($request->ajax()) {
        return response()->json([
            'status'  => true,
            'message' => 'Lead added successfully.',
            'id'      => $insertId
        ], 200);
    }

    return redirect()->route('admin.allprojects')
        ->with('success', 'Lead created successfully!');
}
 
   
    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        return view('admin.project.show', compact('post'));
    }

    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        return view('admin.project.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'city' => 'nullable|string|max:250',
            'state' => 'nullable|string|max:255',
            'lead_status' => 'nullable|in:timepass,exploring,serious',
            'region' => 'nullable|string|max:250',
            'pincode' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'area' => 'nullable|string|max:250',
            'contact_time' => 'nullable|string|max:250',
            'work_type_id' => 'nullable|integer',
            'work_subtype_id' => 'nullable|integer',
            'budget_id' => 'nullable|integer',
            'unit_id' => 'nullable|integer',
            'files' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        $filePath = $post->files;

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('post_files', $fileName, 'public');
        }

        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'work_type_id' => $request->work_type_id ?: null,
            'work_subtype_id' => $request->work_subtype_id ?: null,
            'budget_id' => $request->budget_id ?: null,
            'contact_name' => $request->contact_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'state' => $request->state,
            'region' => $request->region,
            'city' => $request->city,
            'lead_status'     => $request->lead_status,
            'pincode' => $request->pincode,
            'description' => $request->description,
            'area' => $request->area,
            'contact_time' => $request->contact_time,
            'unit_id' => $request->unit_id ?: null,
            'files' => $filePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.allprojects')->with('success', 'Lead updated successfully.');
    }

    public function destroy($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        DB::table('posts')->where('id', $id)->delete();

        return redirect()->route('admin.allprojects')->with('success', 'Lead deleted successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'lead_status' => 'required|in:timepass,exploring,serious',
        ]);

        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Lead not found.'
            ], 404);
        }

        DB::table('posts')->where('id', $id)->update([
            'lead_status' => $request->lead_status,
            'updated_at'  => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Lead status updated successfully.'
        ]);
    }


   public function updateDescription(Request $request, $id)
{
    $request->validate([
        'description' => 'nullable|string',
    ]);

    $post = DB::table('posts')->where('id', $id)->first();

    if (!$post) {
        return response()->json([
            'status' => false,
            'message' => 'Lead not found.'
        ], 404);
    }

    DB::table('posts')->where('id', $id)->update([
        'description' => $request->description,
        'updated_at' => now(),
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Description updated successfully.'
    ]);
}



public function showData($id)
{

    $post = DB::table('posts')->where('id', $id)->first();

    if (!$post) {
        return redirect()->back()->with('error', 'Lead not found.');
    }

    $workTypes = DB::table('work_types')->get();
// dd($service);
    $engineerDesk = DB::table('engineer_desk')->where('post_id', $id)->first();

    return view('admin.project.showdata', compact('post', 'engineerDesk','workTypes'));
}

public function saveEngineerData(Request $request, $id)
{
   
    $post = DB::table('posts')->where('id', $id)->first();

    if (!$post) {
        return redirect()->back()->with('error', 'Lead not found.');
    }

    $validated = $request->validate([
        'customer_requirement' => 'nullable|string',
        'drawing_boq_option'   => 'nullable|in:yes,no',
        'drawing_boq'          => 'nullable|string',
        'plot_size'            => 'nullable|string|max:255',
        'site_condition'       => 'nullable|string',
        'service_type'         => 'nullable|string|max:255',

        'project_name'         => 'nullable|string|max:255',
        'project_location'     => 'nullable|string|max:255',
        'project_budget'       => 'nullable|string|max:255',
        'project_requirement'  => 'nullable|string|max:255',
        'project_timeline'     => 'nullable|string|max:255',
        'project_priority'     => 'nullable|string|max:255',
        'lead_structuring'      => 'nullable|string|max:255',
    ]);

    $data = [
        'post_id'               => $id,
        'owner_name'            => 'Manali',

        'customer_requirement'  => $validated['customer_requirement'] ?? null,
        'drawing_boq'           => ($request->drawing_boq_option === 'yes') ? ($validated['drawing_boq'] ?? null) : null,
        'plot_size'             => $validated['plot_size'] ?? null,
        'site_condition'        => $validated['site_condition'] ?? null,
        'service_type'          => $validated['service_type'] ?? null,

        'project_name'          => $validated['project_name'] ?? null,
        'project_location'      => $validated['project_location'] ?? null,
        'project_budget'        => $validated['project_budget'] ?? null,
        'project_requirement'   => $validated['project_requirement'] ?? null,
        'project_timeline'      => $validated['project_timeline'] ?? null,
        'project_priority'      => $validated['project_priority'] ?? null,
        'lead_structuring' => $validated['lead_structuring'] ?? null,

        'updated_at'            => now(),
    ];
    //  dd($data);

    $existing = DB::table('engineer_desk')->where('post_id', $id)->first();

    if ($existing) {
        DB::table('engineer_desk')
            ->where('post_id', $id)
            ->update($data);

        return redirect()
            ->route('admin.post-leads.showdata', $id)
            ->with('success', 'Engineer Desk details updated successfully.');
    }

    $data['created_at'] = now();

    DB::table('engineer_desk')->insert($data);

    return redirect()
        ->route('admin.post-leads.showdata', $id)
        ->with('success', 'Engineer Desk details saved successfully.');
}


public function vendorStrategy()
{
    $vendorStrategies = DB::table('engineer_desk')
        ->leftJoin('posts', 'engineer_desk.post_id', '=', 'posts.id')
        ->select(
            'engineer_desk.*',
            'posts.title',
            'posts.contact_name',
            'posts.mobile',
            'posts.city_id',
            'posts.files'
        )
        ->orderByDesc('engineer_desk.id')
        ->paginate(10);

    return view('admin.project.vendor_strategy', compact('vendorStrategies'));
}

// public function getVendorsByPost($postId)
// {
//     $post = DB::table('posts')->where('id', $postId)->first();

//     if (!$post) {
//         return response()->json([
//             'status' => false,
//             'html' => '<div class="alert alert-danger mb-0">Project not found.</div>'
//         ]);
//     }

//     // $vendors = DB::table('vendor_register')->get(); 
//     $vendors = DB::table('vendor_register as vr')
//                 ->join('architect_providers as ap', 'vr.id', '=', 'ap.vendor_id')
//                 ->select(
//                     'vr.id',
//                     'vr.full_name',
//                     'vr.mobile',
//                     'vr.email',
//                     'vr.company_name',
//                     'vr.city',
//                     'ap.id as architect_provider_id',
//                     'ap.project_types',
//                     'ap.experience_years',
//                     'ap.team_size',
//                     'ap.state',
//                     'ap.region',
//                     'ap.city_id',
//                     'ap.area_ids'
//                 )
//                 ->get();

//     $html = view('admin.project.partials.vendor_modal_list', compact('vendors', 'post'))->render();

//     return response()->json([
//         'status' => true,
//         'html' => $html
//     ]);
// }
public function getVendorsByPost($postId)
{
    $post = DB::table('posts')->where('id', $postId)->first();

    if (!$post) {
        return response()->json([
            'status' => false,
            'html' => '<div class="alert alert-danger mb-0">Project not found.</div>'
        ]);
    }

    $engineerDesk = DB::table('engineer_desk')->where('post_id', $postId)->first();

    if (!$engineerDesk || empty($engineerDesk->service_type)) {
        return response()->json([
            'status' => false,
            'html' => '<div class="alert alert-warning mb-0">Service type not selected in Engineer Desk.</div>'
        ]);
    }

    $serviceType = trim($engineerDesk->service_type);

    $providerTables = [
        'Architect'  => 'architect_providers',
        'Contractor' => 'contractor_providers',
        'Consultant' => 'consultant_providers',
        'Testing'    => 'testing_providers',
        'Survey'     => 'surveyor_providers',
    ];

    if (!isset($providerTables[$serviceType])) {
        return response()->json([
            'status' => false,
            'html' => '<div class="alert alert-warning mb-0">No provider table mapped for service type: ' . e($serviceType) . '</div>'
        ]);
    }

    $providerTable = $providerTables[$serviceType];

    $vendors = DB::table('vendor_register as vr')
        ->join($providerTable . ' as p', 'vr.id', '=', 'p.vendor_id')
        ->leftJoin('vendor_project_notifications as vpn', function ($join) use ($postId) {
            $join->on('vr.id', '=', 'vpn.vendor_id')
                 ->where('vpn.post_id', '=', $postId);
        })
        ->select(
            'vr.id',
            'vr.full_name',
            'vr.mobile',
            'vr.email',
            'vr.company_name',
            'vr.city',
            DB::raw("'" . $serviceType . "' as service_type"),
            'p.id as provider_id',
            'p.project_types',
            'p.experience_years',
            'p.team_size',
            'p.state',
            'p.region',
            'p.city_id',
            'p.area_ids',
            'vpn.id as notification_id'
        )
        ->get();

    $html = view('admin.project.partials.vendor_modal_list', compact('vendors', 'post', 'serviceType'))->render();

    return response()->json([
        'status' => true,
        'html' => $html
    ]);
}
public function assignVendor(Request $request)
{
    $request->validate([
        'post_id' => 'required|integer',
        'vendor_id' => 'required|integer',
        'service_type' => 'nullable|string|max:255',
    ]);

    $post = DB::table('posts')->where('id', $request->post_id)->first();

    if (!$post) {
        return response()->json([
            'status' => false,
            'message' => 'Project not found.'
        ], 404);
    }

    $alreadyAssigned = DB::table('vendor_project_notifications')
        ->where('post_id', $request->post_id)
        ->where('vendor_id', $request->vendor_id)
        ->first();

    if ($alreadyAssigned) {
        return response()->json([
            'status' => false,
            'message' => 'Vendor already notified for this project.'
        ]);
    }

    $message = 'A new project has been assigned to you. Project: '
        . ($post->title ?? 'Project')
        . ', Location: ' . ($post->city ?? '-')
        . ', Service: ' . ($request->service_type ?? '-');

    DB::table('vendor_project_notifications')->insert([
        'post_id' => $request->post_id,
        'vendor_id' => $request->vendor_id,
        'service_type' => $request->service_type,
        'message' => $message,
        'status' => 'unread',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Vendor assigned successfully.'
    ]);
}
}