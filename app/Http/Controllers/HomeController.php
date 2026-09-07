<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ConstructionEducationPost;
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
        $educationPosts = ConstructionEducationPost::where('is_published', true)
            ->when(request('search'), function ($query, $search) {
                $query->where('title', 'like', '%'.$search.'%');
            })
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('main.constructioneduction', compact('educationPosts'));
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
                'area' => $project['area'] ?? null,
                'floors' => $project['floors'] ?? null,
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
                'title' => 'Bungalow Work in Khopoli',
                'description' => 'Residential bungalow construction work',
                'location' => 'Khopoli',
                'year' => '2025',
                'status' => 'Completed',
                'area' => '1000 sq.ft',
                'floors' => 'G+1',
                'details' => [
                    'This completed bungalow project in Khopoli is a G+1 residential development with an approximate built-up area of 1,000 sq. ft. The project is designed to make effective use of the available space while maintaining a comfortable residential layout.',
                    'The bungalow features a practical two-level configuration with balconies, open frontage, and a well-defined exterior elevation. The overall structure provides a balanced combination of functionality, accessibility, and residential comfort.',
                    'The project has been successfully completed, covering the construction and finishing requirements of the bungalow. The final outcome reflects a neat, functional, and well-executed residential space suitable for everyday family living.',
                ],
                'folder' => 'main/KHOPOLI BANGLO WORK',
                'image' => 'project/main/Group 1307.png',
            ],
            [
                'title' => 'Earthwork Near Imagica',
                'description' => 'Earthwork and site development near Imagica',
                'location' => 'Khopoli',
                'year' => '2025',
                'status' => 'Completed',
                'folder' => 'main/Earthwork Near Imagica',
                'image' => 'project/main/KHOPOLI 2.png',
            ],
            [
                'title' => 'Road Work Near Imagica',
                'description' => 'Road construction and finishing work near Imagica',
                'location' => 'Khopoli',
                'year' => '2025',
                'status' => 'Completed',
                'area' => '12-15 Mtr Internal Roads',
                'details' => [
                    'This completed road work project near Imagica involved the development of a well-finished internal road designed to provide smooth, safe, and reliable access within the project area.',
                    'The work included road formation, surface preparation, leveling, compaction, and bituminous road finishing, along with proper edge development to achieve a neat and durable roadway.',
                    'The project was successfully completed with systematic execution and attention to surface quality, alignment, and overall finish, creating a functional road suitable for regular vehicular movement.',
                ],
                'folder' => 'main/Road Work Near Imagica',
                'image' => 'project/main/KHOPOLI 3.png',
            ],
            [
                'title' => 'Chambers and Pipeline Work',
                'description' => 'Chamber construction and pipeline civil work',
                'location' => 'Maharashtra',
                'year' => '2025',
                'status' => 'Completed',
                'area' => '12-15 Mtr Internal Roads',
                'details' => [
                    'This completed chambers and pipeline work project involved the installation and development of underground utility infrastructure to support proper site services and long-term functionality.',
                    'The work included pipeline laying, trench preparation, alignment, jointing, and chamber construction, along with careful placement and handling of the pipeline during execution.',
                    'The project was successfully completed with systematic installation and proper site coordination, ensuring a well-organized underground pipeline network ready for efficient service and maintenance.',
                ],
                'folder' => 'main/Chambers and Pipeline Work',
                'image' => 'project/main/KHOPOLI 4.png',
            ],
            [
                'title' => 'Kerbstone & Planter works',
                'description' => 'Kerbstone, planter, and external development work',
                'location' => 'Maharashtra',
                'year' => '2025',
                'status' => 'Completed',
                'details' => [
                    'This completed kerbstone and planter works project involved the development of neat roadside edges and landscaped planter areas to improve both functionality and overall site appearance.',
                    'The work included kerbstone installation, edge alignment, planter formation, surface finishing, and coordination with drainage and surrounding roadwork to achieve a clean and well-organized layout.',
                    'The project was successfully completed with proper alignment, finishing, and attention to detail, enhancing the durability, safety, and visual quality of the developed area.',
                ],
                'folder' => 'main/Kerbstone & Planter works',
                'image' => 'project/main/KHOPOLI 5.png',
            ],
            [
                'title' => 'Demarcation & Plotting',
                'description' => 'Land demarcation and plotting work',
                'location' => 'Maharashtra',
                'year' => '2025',
                'status' => 'Completed',
                'details' => [
                    'This completed demarcation and plotting works project involved systematic land division and on-ground marking to create clearly defined individual plots within the development area.',
                    'The work included plot boundary demarcation, internal layout marking, plot subdivision, leveling coordination, and physical identification of plot lines as per the approved site planning requirements.',
                    'The project was successfully completed with accurate execution and organized plot formation, creating a clearly structured land layout ready for further infrastructure development and individual plot utilization.',
                ],
                'folder' => 'main/Demarcation & Plotting works',
                'image' => 'project/main/KHOPOLI 6.png',
            ],
            [
                'title' => 'Land Filling Work in Pen',
                'description' => 'Land filling and leveling work in Pen',
                'location' => 'Pen',
                'year' => '2025',
                'status' => 'Completed',
                'details' => [
                    'This completed land filling project in Pen involved systematic filling and ground preparation to achieve the required site levels for future development and construction activities.',
                    'The work included soil spreading, layer-wise filling, leveling, grading, and compaction using heavy equipment, ensuring a stable and properly prepared ground surface across the site.',
                    'The project was successfully completed with focus on level accuracy, ground stability, and efficient site execution, creating a strong and workable base for the next stage of development.',
                ],
                'folder' => 'main/Land Filling Work in Pen',
                'image' => 'project/main/KHOPOLI 10.png',
            ],
            [
                'title' => 'Strengthening & Retrofitting Work',
                'description' => 'Strengthening and retrofitting work',
                'location' => 'Maharashtra',
                'year' => '2025',
                'status' => 'Completed',
                'details' => [
                    'This completed strengthening and retrofitting work involved structural repair and improvement activities to enhance the safety, durability, and service life of the existing structure.',
                    'The work included surface preparation, removal of damaged portions, reinforcement treatment, repair mortar application, strengthening measures, and finishing work as per site requirements.',
                    'The project was successfully completed with attention to structural stability, workmanship quality, and practical execution, helping restore and improve the performance of the affected building elements.',
                ],
                'folder' => 'main/Strengthening and Retrofitting Work',
                'image' => 'project/main/KHOPOLI 11.png',
            ],
            [
                'title' => 'Retaining Wall Work Near Imagica',
                'description' => 'Retaining wall construction near Imagica',
                'location' => 'Khopoli',
                'year' => '2025',
                'status' => 'In Progress',
                'details' => [
                    'This retaining wall project near Imagica involved the construction of a strong RCC retaining structure to support the surrounding soil and stabilize the developed site area.',
                    'The work included excavation, reinforcement, shuttering, concreting, drainage provisions, and wall finishing, executed with proper alignment and structural control to ensure long-term performance.',
                    'The project is progressing with focus on safety, durability, and site stability, providing reliable earth retention and protection against soil movement and erosion.',
                ],
                'folder' => 'main/Retaining Wall Work Near Imagica',
                'image' => 'project/main/KHOPOLI 7.png',
            ],
            [
                'title' => 'Clubhouse Work Near Khalapur',
                'description' => 'Clubhouse civil construction work near Khalapur',
                'location' => 'Khalapur',
                'year' => '2025',
                'status' => 'In Progress',
                'details' => [
                    'This clubhouse project near Khalapur is currently in progress and involves the development of a dedicated recreational and community facility within the project premises.',
                    'The ongoing work includes RCC structural construction, reinforcement, shuttering, concreting, column and slab work, and overall structural development, carried out as per the planned design and execution sequence.',
                    'The project is being executed with focus on structural quality, safety, durability, and proper site coordination, with the next stages progressing toward masonry, finishing, services, and final clubhouse development.',
                ],
                'folder' => 'main/Clubhouse Work Near Khalapur',
                'image' => 'project/main/KHOPOLI 9.png',
            ],
            [
                'title' => 'Plum Concrete Work Near Imagica',
                'description' => 'Plum concrete work near Imagica',
                'location' => 'Khopoli',
                'year' => '2025',
                'status' => 'In Progress',
                'details' => [
                    'This plum concrete work project near Imagica is currently in progress and involves the construction of a strong mass concrete section for structural support and site stability.',
                    'The ongoing work includes shuttering, placement of large stones, concrete filling, compaction, leveling, and section-wise execution as per the required construction levels and site conditions.',
                    'The project is progressing with focus on strength, durability, proper alignment, and quality workmanship, ensuring a solid base for the upcoming stages of construction.',
                ],
                'folder' => 'main/Plum Concrete Work Near Imagica',
                'image' => 'project/main/KHOPOLI 12.png',
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
