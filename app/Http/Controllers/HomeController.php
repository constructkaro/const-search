<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function chooserightcontractor(){
        return view('main.chooserightcontractor');
    }
    
    public function constructionarticle(){
        return view('main.constructionarticle');
    }

    public function differentconsultant(){
        return view('main.differentconsultant');
    }

    public function blogsinsights(){
        return view('main.blogsinsights');
    }
    
    public function blogsinsightspage(){
        return view('main.blogsinsightspage');
    }

    public function aboutus(){
        return view('main.aboutus');
    }

    public function aboutwhome(){
        return view('main.aboutwhome');
    }

    public function ourbaround(){
        return view('main.ourbaround');
    }

    public function coreproblem(){
        return view('main.coreproblem');
    }

    public function canstructkarodifferent(){
        return view('main.canstructkarodifferent');
    }

    public function guide_me(){
        return view('main.guide_me');
    }

    public function architect_services(){
        return view('main.architect_services');
    }

    public function interior_services(){
        return view('main.interior_services');
    }

    public function contractor_services(){
        return view('main.contractor_services');

    }

    public function survey_services(){
        return view('main.survey_services');
    }

    public function survey_testing(){
        return view('main.survey_testing');

    }

    public function boq_testing(){
        return view('main.boq_testing');
    }

    public function confused_guide_me(){
         $cities = DB::table('city')
        ->orderBy('name', 'asc')
        ->get();
        return view('main.confused_guied_me', compact('cities'));
    }

//   public function packageMaterial($city, $package)
// {
//     if (!in_array($package, ['standard', 'premium', 'luxury'])) {
//         abort(404);
//     }

//     $allowedCities = [
//         'pune',
//         'mumbai',
//         'navi-mumbai',
//         'raigad',
//         'thane',
//         'pimpri-chinchwad'
//     ];

//     if (!in_array($city, $allowedCities)) {
//         abort(404);
//     }

//     $cities = DB::table('city')
//         ->orderBy('name', 'asc')
//         ->get();

//     $selectedCity = $city;

//     return view('main.package_material', compact('package', 'cities', 'selectedCity'));
// }
public function packageMaterial($city, $package)
{
    if (!in_array($package, ['standard', 'premium', 'luxury'])) {
        abort(404);
    }

    $allowedCities = [
        'pune',
        'mumbai',
        'navi-mumbai',
        'raigad',
        'thane',
        'pimpri-chinchwad'
    ];

    if (!in_array($city, $allowedCities)) {
        abort(404);
    }

    $cities = DB::table('city')->orderBy('name', 'asc')->get();

    $selectedCity = $city;

    $materials = [
        'pune' => [
            'cement' => ['standard' => 'Shree Cement', 'premium' => 'ACC Cement, Ambuja Cement, JK Super Cement', 'luxury' => 'UltraTech Cement'],
            'steel' => ['standard' => 'Kamdhenu Steel, Pushpa steel, Samruddhi Composites (IS Certified)', 'premium' => 'Tata Steel, JSW Steel', 'luxury' => 'Tata Steel, JSW Steel'],
            'bricks' => ['standard' => 'Local Clay Bricks (Quality Tested Bricks)', 'premium' => 'Fly Ash Bricks', 'luxury' => 'AAC Blocks (Siporex, Magicrete, Bigbloc Construction Ltd-NXT)'],
        ],

        'mumbai' => [
            'cement' => ['standard' => 'Shree Cement', 'premium' => 'ACC Cement, Ambuja Cement, JK Super Cement', 'luxury' => 'UltraTech Cement'],
            'steel' => ['standard' => 'Kamdhenu Steel, Pushpa steel, Samruddhi Composites (IS Certified)', 'premium' => 'Tata Steel, JSW Steel', 'luxury' => 'Tata Steel, JSW Steel'],
            'bricks' => ['standard' => 'Local Clay Bricks (Quality Tested Bricks)', 'premium' => 'Fly Ash Bricks', 'luxury' => 'AAC Blocks (Siporex, Magicrete, Bigbloc Construction Ltd-NXT)'],
        ],

        'navi-mumbai' => [
            'cement' => ['standard' => 'Shree Cement', 'premium' => 'ACC Cement, Ambuja Cement, JK Super Cement', 'luxury' => 'UltraTech Cement'],
            'steel' => ['standard' => 'Kamdhenu Steel, Pushpa steel, Samruddhi Composites (IS Certified)', 'premium' => 'Tata Steel, JSW Steel', 'luxury' => 'Tata Steel, JSW Steel'],
            'bricks' => ['standard' => 'Local Clay Bricks (Quality Tested Bricks)', 'premium' => 'Fly Ash Bricks', 'luxury' => 'AAC Blocks (Siporex, Magicrete, Bigbloc Construction Ltd-NXT)'],
        ],
    ];

    // Pimpri Chinchwad same as Pune
    $materials['pimpri-chinchwad'] = $materials['pune'];

    // Raigad and Thane same as Navi Mumbai for now
    $materials['raigad'] = $materials['navi-mumbai'];
    $materials['thane'] = $materials['navi-mumbai'];

    $material = $materials[$selectedCity];

    return view('main.package_material', compact(
        'package',
        'cities',
        'selectedCity',
        'material'
    ));
}

public function turnkeyMaterial($city, $package)
{
    if (!in_array($package, ['standard', 'premium', 'luxury'])) {
        abort(404);
    }

    $allowedCities = [
        'pune',
        'mumbai',
        'navi-mumbai',
        'raigad',
        'thane',
        'pimpri-chinchwad'
    ];

    if (!in_array($city, $allowedCities)) {
        abort(404);
    }

    $cities = DB::table('city')->orderBy('name', 'asc')->get();
    $selectedCity = $city;

    return view('main.turnkey_material', compact('cities', 'selectedCity', 'package'));
}




}
