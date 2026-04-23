<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Facades\DB;
class VendorController extends Controller
{
  

public function vendorstore(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'mobile' => 'required|digits:10|unique:vendor_register,mobile',
        'email' => 'required|email|max:255|unique:vendor_register,email',
        'company_name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'Area' => 'required|string',
        'pincode' => 'required|digits:6',
        'business_address' => 'required|string|max:500',
        'business_entity' => 'required|string|max:255',
        'password' => 'required|min:6|confirmed',
    ], [
        'mobile.unique' => 'This mobile number is already registered.',
        'email.unique' => 'This email is already registered.',
        'password.confirmed' => 'Password and confirm password do not match.',
    ]);

    DB::table('vendor_register')->insert([
        'full_name' => $validated['full_name'],
        'mobile' => $validated['mobile'],
        'Area'  =>$validated['Area'],
        'email' => $validated['email'],
        'company_name' => $validated['company_name'],
        'city' => $validated['city'],
        'pincode' => $validated['pincode'],
        'business_address' => $validated['business_address'],
        'business_entity' => $validated['business_entity'],
        'password' => Hash::make($validated['password']),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Vendor registered successfully. Please login.');
}


public function test(){
    return view('test');
}

public function notifications()
{
    $vendorId = session('vendor_id');

    $notifications = DB::table('vendor_project_notifications as vpn')
        ->join('posts as p', 'vpn.post_id', '=', 'p.id')
        ->leftJoin('vendor_notification_responses as vr', function ($join) use ($vendorId) {
            $join->on('vr.notification_id', '=', 'vpn.id')
                 ->where('vr.vendor_id', '=', $vendorId);
        })
        ->where('vpn.vendor_id', $vendorId)
        ->select(
            'vpn.*',
            'p.*',
            'vr.is_interested',
            'vr.boq_file'
        )
        ->orderByDesc('vpn.id')
        ->get();
// dd($notifications );
    return view('vendor.notifications', compact('notifications'));
}

// public function notifications()
// {
//     $vendorId = session('vendor_id');

//     $notifications = DB::table('vendor_project_notifications as vpn')
//         ->join('posts as p', 'vpn.post_id', '=', 'p.id')
//         ->where('vpn.vendor_id', $vendorId)
//         ->leftJoin('vendor_notification_responses as vr', function ($join) use ($vendorId) {
//                 $join->on('vr.notification_id', '=', 'vn.id')
//                     ->where('vr.vendor_id', '=', $vendorId);
//             })
//         ->select(
//             'vpn.*',
//             'p.*', 'vr.is_interested',
//             'vr.boq_file'
//             // 'p.contact_name',
//             // 'p.mobile',
//             // 'p.city_id',
//             // 'p.description',
//             // 'p.files'
//         )
//         ->where('vpn.vendor_id', $vendorId)
//         ->orderByDesc('vpn.id')
//         ->get();
// // dd($notifications);
//     return view('vendor.notifications', compact('notifications'));
// }

// public function notificationResponse(Request $request)
// {
//     $request->validate([
//         'notification_id' => 'required',
//         'post_id' => 'required',
//         'is_interested' => 'nullable|in:0,1',
//         'boq_file' => 'nullable|file|mimes:pdf,xls,xlsx,jpg,jpeg,png|max:5120',
//     ]);

//     $filePath = null;

//     if ($request->hasFile('boq_file')) {
//         $filePath = $request->file('boq_file')->store('vendor_boq_files', 'public');
//     }

//     $exists = DB::table('vendor_notification_responses')
//     ->where('notification_id', $request->notification_id)
//     ->where('vendor_id', session('vendor_id'))
//     ->first();

//     if ($exists) {

//         DB::table('vendor_notification_responses')
//             ->where('id', $exists->id)
//             ->update([
//                 'is_interested' => $request->is_interested ?? 0,
//                 'boq_file' => $filePath ?? $exists->boq_file,
//                 'updated_at' => now()
//             ]);

//     } else {

//         DB::table('vendor_notification_responses')->insert([
//             'notification_id' => $request->notification_id,
//             'post_id' => $request->post_id,
//             'vendor_id' => session('vendor_id'),
//             'is_interested' => $request->is_interested ?? 0,
//             'boq_file' => $filePath,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
    

//     return response()->json([
//         'status' => true,
//         'message' => 'Your response has been submitted successfully.'
//     ]);
// }
public function notificationResponse(Request $request)
{
    
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return response()->json([
                'status' => false,
                'message' => 'Vendor session expired. Please login again.'
            ], 401);
        }

        $request->validate([
            'notification_id' => 'required|integer',
            'post_id' => 'required|integer',
            'is_interested' => 'nullable|in:0,1',
            'boq_file' => 'nullable|file|mimes:pdf,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('boq_file')) {
            $filePath = $request->file('boq_file')->store('vendor_boq_files', 'public');
        }

        $exists = DB::table('vendor_notification_responses')
            ->where('notification_id', $request->notification_id)
            ->where('vendor_id', $vendorId)
            ->first();

        if ($exists) {
            DB::table('vendor_notification_responses')
                ->where('id', $exists->id)
                ->update([
                    'post_id'       => $request->post_id,
                    'is_interested' => $request->is_interested ?? 0,
                    'boq_file'      => $filePath ?: $exists->boq_file,
                    'updated_at'    => now(),
                ]);

            return response()->json([
                'status' => true,
                'message' => 'Your response has been updated successfully.'
            ]);
        }

        DB::table('vendor_notification_responses')->insert([
            'notification_id' => $request->notification_id,
            'post_id'         => $request->post_id,
            'vendor_id'       => $vendorId,
            'is_interested'   => $request->is_interested ?? 0,
            'boq_file'        => $filePath,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Your response has been submitted successfully.'
        ]);

}
}