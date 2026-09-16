<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class VendorAuthController extends Controller
{
    public function showLogin()
    {
        return view('vendor.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'password' => 'required',
        ]);

        $vendor = DB::table('vendor_register')
            ->where('mobile', $request->mobile)
            ->first();

        if (!$vendor) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Mobile number not found.');
        }

        if (!Hash::check($request->password, $vendor->password)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid password.');
        }

        Session::put('vendor_id', $vendor->id);
        Session::put('vendor_name', $vendor->full_name);
        Session::put('vendor_mobile', $vendor->mobile);

        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        if (!Session::has('vendor_id')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $vendorId = Session::get('vendor_id');

        $notificationCount = Schema::hasTable('vendor_project_notifications')
            ? DB::table('vendor_project_notifications')->where('vendor_id', $vendorId)->count()
            : 0;

        $unreadCount = Schema::hasTable('vendor_project_notifications')
            ? DB::table('vendor_project_notifications')
                ->where('vendor_id', $vendorId)
                ->where('status', 'unread')
                ->count()
            : 0;

        $interestedCount = Schema::hasTable('vendor_notification_responses')
            ? DB::table('vendor_notification_responses')
                ->where('vendor_id', $vendorId)
                ->where('is_interested', 1)
                ->count()
            : 0;

        $completedProfiles = collect([
            'Contractor' => 'contractor_providers',
            'Architect' => 'architect_providers',
            'Interior Designer' => 'interior_providers',
            'Surveyor' => 'surveyor_providers',
            'BOQ / Estimation Expert' => 'vendor_boq_profiles',
            'Structural Auditor / Engineer' => 'structural_audit_providers',
        ])->filter(function ($table) use ($vendorId) {
            return Schema::hasTable($table)
                && DB::table($table)->where('vendor_id', $vendorId)->exists();
        })->keys()->values();

        $latestNotifications = Schema::hasTable('vendor_project_notifications')
            ? DB::table('vendor_project_notifications as vpn')
                ->leftJoin('posts as p', 'vpn.post_id', '=', 'p.id')
                ->where('vpn.vendor_id', $vendorId)
                ->select(
                    'vpn.id',
                    'vpn.post_id',
                    'vpn.status',
                    'vpn.created_at',
                    'p.title',
                    'p.service_type',
                    'p.city_id'
                )
                ->orderByDesc('vpn.id')
                ->limit(5)
                ->get()
            : collect();

        return view('vendor.vendor_dashboard', [
            'notificationCount' => $notificationCount,
            'unreadCount' => $unreadCount,
            'interestedCount' => $interestedCount,
            'completedProfiles' => $completedProfiles,
            'latestNotifications' => $latestNotifications,
        ]);
    }

    public function logout()
    {
        Session::forget('vendor_id');
        Session::forget('vendor_name');
        Session::forget('vendor_mobile');

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
