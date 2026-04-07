<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        return view('vendor.vendor_dashboard');
    }

    public function logout()
    {
        Session::forget('vendor_id');
        Session::forget('vendor_name');
        Session::forget('vendor_mobile');

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}