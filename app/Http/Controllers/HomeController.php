<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        $blogs = Blog::where('is_published', true)
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%'.$search.'%')
                        ->orWhere('excerpt', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%')
                        ->orWhere('content_blocks', 'like', '%'.$search.'%');
                });
            })
            ->orderByDesc('published_at')
            ->latest()
            ->get();

        return view('main.blogsinsights', compact('blogs'));
    }
    
    public function blogsinsightspage(){
        return view('main.blogsinsightspage');
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('main.blog_show', compact('blog'));
    }

    public function caseStudies(){
        return view('main.case_studies');
    }

    public function mumbaiPuneMissingLinkCaseStudy(){
        return view('main.mumbai_pune_missing_link_case_study');
    }

    public function houseConstructionPlotCaseStudy(){
        return view('main.house_construction_plot_case_study');
    }

    public function completedProjects(){
        $projects = collect($this->completedProjectItems())->map(function ($project) {
            return (object) [
                'title' => $project['title'],
                'slug' => $project['slug'],
                'description' => $project['description'],
                'location' => $project['location'],
                'year' => $project['year'],
                'status' => $project['status'],
                'images' => collect([(object) ['image_path' => $project['image']]]),
            ];
        });

        return view('main.completed_projects', compact('projects'));
    }

    public function completedProjectShow($slug)
    {
        $project = collect($this->completedProjectItems())
            ->map(fn ($project) => (object) $project)
            ->firstWhere('slug', $slug);

        if (!$project) {
            abort(404);
        }

        $imageFiles = [];
        $projectPath = public_path('project/' . $project->folder);

        if ($project->folder && File::isDirectory($projectPath)) {
            $imageFiles = collect(File::files($projectPath))
                ->filter(fn ($file) => in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']))
                ->sortBy(function ($file) {
                    $number = (int) preg_replace('/\D+/', '', $file->getFilename());

                    return $number > 0 ? $number : $file->getFilename();
                })
                ->map(fn ($file) => 'project/' . $project->folder . '/' . $file->getFilename())
                ->values()
                ->all();
        }

        if (empty($imageFiles)) {
            $imageFiles = [$project->image];
        }

        return view('main.completed_project_show', compact('project', 'imageFiles'));
    }

    private function completedProjectItems()
    {
        return collect([
           
            [
                'title' => 'Road work & Storm water drain',
                'description' => 'Godrej',
                'location' => 'Godrej',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'godrej',
                'image' => 'project/godrej/1.jpg',
            ],
            [
                'title' => 'Civil & Infra Activity',
                'description' => 'Civil & Infra Activity',
                'location' => 'Kalote',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'civilkalote',
                'image' => 'project/civilkalote/1.jpeg',
            ],
          
            [
                'title' => 'Strengthening and Retrofitting Work',
                'description' => 'Oriental Aromatics',
                'location' => 'Oriental Aromatics',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'John',
                'image' => 'project/John/1.jpg',
            ],
         
            [
                'title' => 'Civil and Allied Activities at Various Locations',
                'description' => 'Civil and allied activities at various locations',
                'location' => 'Maharashtra',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'ste',
                'image' => 'project/ste/1.jpg',
            ],
            [
                'title' => 'Earthwork of 2.75 Pipe at Khopoli',
                'description' => 'Nagothane Ethane Pipeline Project',
                'location' => 'Khopoli',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'Warai',
                'image' => 'project/Warai/1.jpg',
            ],
           
            [
                'title' => 'Building Project',
                'description' => 'Apartment / Building Project',
                'location' => 'Maharashtra',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'building',
                'image' => 'project/building/2.JPG',
            ],
           
        
            [
                'title' => 'Bungalow Construction Work',
                'description' => 'Residential bungalow construction work',
                'location' => 'Maharashtra',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'banglo',
                'image' => 'project/banglo/1.png',
            ],
        ])->map(function ($project) {
            $project['slug'] = Str::slug($project['title']);

            return $project;
        })->all();
    }

    public function aboutus(){
        return view('main.aboutus');
    }

    public function privacy_policy(){
        return view('main.privacy_policy');
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

    public function residential_interior_design(){
        return view('main.residential_interior_design');
    }

    public function commercial_interior_design(){
        return view('main.commercial_interior_design');
    }

    public function retail_showroom_interior(){
        return view('main.retail_showroom_interior');
    }

    public function hospitality_interior_design(){
        return view('main.hospitality_interior_design');
    }

    public function industrial_specialized_interior(){
        return view('main.industrial_specialized_interior');
    }

    public function contractor_services(){
        return view('main.contractor_services');

    }

    public function contractor_services_new(){
        return view('main.constractor_services_new');

    }

    public function contractorServiceDetails($slug)
    {
        $views = [
            'residential-contractor' => 'main.contractor_service_residential',
            'road-highway-contractor' => 'main.contractor_service_road_highway',
            'bridge-contractor' => 'main.contractor_service_bridge',
            'earthwork-excavation-contractor' => 'main.contractor_service_earthwork_excavation',
            'culverts-contractor' => 'main.contractor_service_culverts',
            'commercial-contractor' => 'main.contractor_service_commercial',
            'industrial-civil-contractor' => 'main.contractor_service_industrial_civil',
            'landscaping-contractor' => 'main.contractor_service_landscaping',
            'mep-contractor' => 'main.contractor_service_mep',
            'paint-contractor' => 'main.contractor_service_paint',
            'waterproofing-contractor' => 'main.contractor_service_waterproofing',
            'labour-contractor' => 'main.contractor_service_labour',
        ];

        if (!array_key_exists($slug, $views)) {
            abort(404);
        }

        return view($views[$slug]);
    }

    public function survey_services(){
        return view('main.survey_services');
    }

    public function boundary_survey_services(){
        return view('main.boundary_survey_services');
    }

    public function topographic_survey_services(){
        return view('main.topographic_survey_services');
    }

    public function total_station_survey_services(){
        return view('main.total_station_survey_services');
    }

    public function dgps_survey_services(){
        return view('main.dgps_survey_services');
    }

    public function layout_plotting_survey_services(){
        return view('main.layout_plotting_survey_services');
    }

    public function construction_layout_survey_services(){
        return view('main.construction_layout_survey_services');
    }

    public function drone_survey_services(){
        return view('main.drone_survey_services');
    }

    public function road_infrastructure_survey_services(){
        return view('main.road_infrastructure_survey_services');
    }

      public function survey_structural(){
        return view('main.survey_structural');
    }

    public function residential_structural_audit(){
        return view('main.residential_structural_audit');
    }

    public function commercial_structural_audit(){
        return view('main.commercial_structural_audit');
    }

    public function industrial_structural_audit(){
        return view('main.industrial_structural_audit');
    }

    public function pre_purchase_structural_inspection(){
        return view('main.pre_purchase_structural_inspection');
    }

    public function renovation_repair_structural_audit(){
        return view('main.renovation_repair_structural_audit');
    }

    public function survey_testing(){
        return view('main.survey_testing');

    }

    public function boq_testing(){
        return view('main.boq_testing');
    }

    public function residential_boq(){
        return view('main.residential_boq');
    }

    public function commercial_boq(){
        return view('main.commercial_boq');
    }

    public function structural_boq(){
        return view('main.structural_boq');
    }

    public function interior_boq(){
        return view('main.interior_boq');
    }

    public function renovation_repair_estimation(){
        return view('main.renovation_repair_estimation');
    }

    public function confused_guide_me(){
         $cities = DB::table('city')
        ->orderBy('name', 'asc')
        ->get();
        return view('main.confused_guied_me', compact('cities'));
    }


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




public function architecturalServiceDetails($slug)
{
    $services = [
        'residential-architectural-planning' => [
            'title' => 'Residential Architectural Planning',
            'desc' => 'Planning for houses, villas, and residential layouts with proper space utilization.',
        ],

        'bungalow-and-villa-design' => [
            'title' => 'Bungalow and Villa Design',
            'desc' => 'Custom bungalow and villa designs based on plot size, lifestyle, and budget.',
            'view' => 'services.bungalow-villa-design',
        ],

        'apartment-flat-layout-planning' => [
            'title' => 'Apartment and Flat Layout Planning',
            'desc' => 'Efficient flat layouts with ventilation, light, and functional design.',
            'view' => 'services.apartment-flat-layout-planning',
        ],

        'commercial-building-design' => [
            'title' => 'Commercial Building Design',
            'desc' => 'Design for offices, shops, malls, and commercial spaces.',
        ],

        'office-and-showroom-planning' => [
            'title' => 'Office and Showroom Planning',
            'desc' => 'Modern office and showroom layouts for business needs.',
        ],

        'showroom-planning' => [
            'title' => 'Showroom Planning',
            'desc' => 'Modern showroom layouts for retail, bike, car, and product display spaces.',
            'view' => 'services.showroom-planning',
        ],

        'farmhouse-design' => [
            'title' => 'Farmhouse Design',
            'desc' => 'Farmhouse planning with landscape and open space concepts.',
            'view' => 'services.farmhouse-design',
        ],

        'plot-development-planning' => [
            'title' => 'Plot Development Planning',
            'desc' => 'Layout planning for plotting projects and land development.',
            'view' => 'services.plot-development-planning',
        ],

        'elevation-and-facade-design' => [
            'title' => 'Elevation and Facade Design',
            'desc' => 'Front elevation and facade design for modern and premium look.',
            'view' => 'services.elevation-and-facade-design',
        ],

        'floor-plan-design' => [
            'title' => 'Floor Plan Design',
            'desc' => 'Detailed floor planning with proper space utilization.',
            'view' => 'services.floor-plan-design',
        ],

        'space-planning' => [
            'title' => 'Space Planning',
            'desc' => 'Smart space planning for better functionality and flow.',
            'view' => 'services.space-planning',
        ],

        'concept-design' => [
            'title' => 'Concept Design',
            'desc' => 'Initial concept design based on your ideas and requirements.',
            'view' => 'services.concept-design',
        ],

        'renovation-planning' => [
            'title' => 'Renovation Planning',
            'desc' => 'Planning for renovation and redesign of existing structures.',
            'view' => 'services.renovation-planning',
        ],

        'approval-drawing-support' => [
            'title' => 'Approval Drawing Support',
            'desc' => 'Support for municipal approval drawings and documentation.',
            'view' => 'services.approval-drawing-support',
        ],

        'submission-drawing-assistance' => [
            'title' => 'Submission Drawing Assistance',
            'desc' => 'Assistance in preparing drawings for submission process.',
            'view' => 'services.submission-drawing-assistance',
        ],

        'basic-design-consultation' => [
            'title' => 'Basic Design Consultation',
            'desc' => 'Consultation for design ideas, layout, and planning guidance.',
            'view' => 'services.basic-design-consultation',
        ],
    ];

    if (!array_key_exists($slug, $services)) {
        abort(404);
    }

    $service = $services[$slug];

    $view = $service['view'] ?? 'services.architectural-details';

    return view($view, compact('service', 'slug'));
}

}
