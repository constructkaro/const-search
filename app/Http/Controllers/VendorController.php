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


}