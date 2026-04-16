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


    public function constructioneduction(){
        return view('main.constructioneduction');
    }

    public function constwork(){
          return view('main.constwork');
        
    }

    public function surveyservicesstep(){
         return view('main.surveyservicesstep');
    }

    public function testingservicessteps(){
        return view('main.testingservicessteps');
    }

    public function nasupportsteps(){
        return view('main.nsandlegalsteps');
    }

    public function boqservicessteps(){
        return view('main.boqservicessteps');

        
    }

    public function facadeservicesteps(){
        return view('main.facadeservicesteps'); 
    }

    public function interiordesignersteps(){
        return view('main.interiordesignersteps'); 
    }

    public function structuralauditsteps(){
        return view('main.structuralauditsteps'); 
    }

    public function weldingandfabricationsteps(){
         return view('main.weldingandfabricationsteps');
    }

    public function architectsteps(){
        return view('main.architectsteps');
        
    }

    public function contractorsteps(){
        return view('main.contractorsteps');
        
    }

    
    
}
