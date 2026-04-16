<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HelpCenterCallback;

class HomeController extends Controller
{
    public function helpcenter(){
        return view('main.helpcenter');
    }

     public function submitCallback(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'mobile'  => 'required|string|max:20',
            'city'    => 'required|string|max:100',
            'area'    => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
        ], [
            'name.required'   => 'Please enter your name.',
            'mobile.required' => 'Please enter your mobile number.',
            'city.required'   => 'Please select your city.',
        ]);

        HelpCenterCallback::create([
            'name'    => $request->name,
            'mobile'  => $request->mobile,
            'city'    => $request->city,
            'area'    => $request->area,
            'pincode' => $request->pincode,
        ]);

        return redirect()->back()->with('success', 'Your callback request has been submitted successfully.');
    }

    public function knowledgehub(){
        return view('main.knowledgehub');
    }
}
