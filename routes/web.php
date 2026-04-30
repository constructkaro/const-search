<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceAvailabilityController;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\NaLegalController;
use App\Http\Controllers\FabricationServiceController;
use App\Http\Controllers\VendorBoqProfileController;
use App\Http\Controllers\MachineryProviderController;
use App\Http\Controllers\FacadeServicesController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\ArchitectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InteriorController;
use App\Http\Controllers\StructuralAuditController;

use App\Http\Controllers\TestingEnquiryController;
use App\Http\Controllers\BoqEnquiryController;
use App\Http\Controllers\NaSupportController;
use App\Http\Controllers\FacadeEnquiryController;
use App\Http\Controllers\StructuralAuditEnquiryController;
use App\Http\Controllers\WeldingFabricationController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Customer\OrderTrackingController;
use App\Http\Controllers\Admin\TrackingTemplateController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\EngineerDeskController;
use App\Http\Controllers\Admin\PostLeadController;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\ConstructionRequirementController;

Route::get('/test', [VendorController::class, 'test'])->name('test');


/*
|--------------------------------------------------------------------------
| Admin Login
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role:admin,super_admin,telecaller'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/contractor', [OrderController::class, 'contractorOrders'])->name('orders.contractor');
    Route::get('/orders/interior', [OrderController::class, 'interiorOrders'])->name('orders.interior');
    Route::get('/orders/survey', [OrderController::class, 'surveyOrders'])->name('orders.survey');
    Route::get('/orders/testing', [OrderController::class, 'testingOrders'])->name('orders.testing');
    Route::get('/orders/boq', [OrderController::class, 'boqOrders'])->name('orders.boq');

      Route::get('/tracking-templates', [TrackingTemplateController::class, 'index'])->name('tracking_templates.index');
    Route::post('/tracking-templates/store', [TrackingTemplateController::class, 'store'])->name('tracking_templates.store');
    Route::post('/tracking-templates/update/{id}', [TrackingTemplateController::class, 'update'])->name('tracking_templates.update');
    Route::post('/tracking-templates/delete/{id}', [TrackingTemplateController::class, 'delete'])->name('tracking_templates.delete');

     Route::get('/order-tracking', [TrackingTemplateController::class, 'adminOrders'])->name('order_tracking.index');
    Route::post('/order-tracking/assign', [TrackingTemplateController::class, 'assignTemplate'])->name('order_tracking.assign');

    Route::get('/order-tracking/{service_key}/{source_id}', [TrackingTemplateController::class, 'manageSteps'])
        ->name('order_tracking.steps');

    Route::post('/order-tracking/step-update/{id}', [TrackingTemplateController::class, 'updateStep'])
        ->name('order_tracking.step_update');


    Route::get('/engineer-desk/create', [EngineerDeskController::class, 'create'])->name('engineer-desk.create');
    Route::post('/engineer-desk/store', [EngineerDeskController::class, 'store'])->name('engineer-desk.store');
    Route::get('/engineer-desk/{id}/edit', [EngineerDeskController::class, 'edit'])->name('engineer-desk.edit');
    Route::post('/engineer-desk/{id}/update', [EngineerDeskController::class, 'update'])->name('engineer-desk.update');
   
});



Route::middleware(['auth', 'role:super_admin,telecaller,admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::post('/users/store', [AdminController::class, 'storeUser'])->name('users.store');
        Route::delete('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

        Route::get('/vendors', [AdminController::class, 'allvendors'])->name('allvendors');


        Route::get('/projects', [PostLeadController::class, 'index'])->name('allprojects');
        Route::get('/post-leads/create', [PostLeadController::class, 'create'])->name('post-leads.create');
        Route::post('/post-leads/store', [PostLeadController::class, 'store'])->name('save.adminpost');
        
        Route::get('/post-leads/{id}/show', [PostLeadController::class, 'show'])->name('post-leads.show');
        Route::get('/post-leads/{id}/edit', [PostLeadController::class, 'edit'])->name('post-leads.edit');
        Route::post('/post-leads/{id}/update', [PostLeadController::class, 'update'])->name('post-leads.update');
        Route::delete('/post-leads/{id}/delete', [PostLeadController::class, 'destroy'])->name('post-leads.destroy');
        
        Route::post('/post-leads/{id}/update-status', [PostLeadController::class, 'updateStatus'])->name('post-leads.update-status');

        Route::post('/post-leads/{id}/update-description', [PostLeadController::class, 'updateDescription'])
        ->name('post-leads.update-description');


        Route::get('/post-leads/{id}/showdata', [PostLeadController::class, 'showData'])->name('post-leads.showdata');
        Route::post('/post-leads/{id}/save-engineer-data', [PostLeadController::class, 'saveEngineerData'])->name('post-leads.saveEngineerData');

        Route::get('/vendor-strategy', [PostLeadController::class, 'vendorStrategy'])->name('vendor.strategy');

        Route::get('/vendor-strategy/{postId}/vendors', [PostLeadController::class, 'getVendorsByPost'])
    ->name('admin.vendor.strategy.vendors');

    Route::post('/admin/assign-vendor', [PostLeadController::class, 'assignVendor'])->name('assign.vendor');

    Route::get('/admin/vendors/{vendor}/forms', [AdminController::class, 'vendorForms'])
    ->name('vendors.forms');
    });


// //vendor
// Route::domain('vendor.constructkaro.com')->group(function () {
//     Route::get('/', function () {
    // Route::get('/vendor', function () {
    //      return view('vendor.welcome');
    // })->name('vendor');

// Route::get('/', [VendorController::class, 'welcome'])->name('vendor');

Route::get('/vendor', [VendorController::class, 'welcome'])->name('vendor');

    Route::get('/vendor/boq-form', [VendorBoqProfileController::class, 'create'])->name('vendor.boq.form');
    Route::post('/vendor/boq-form', [VendorBoqProfileController::class, 'store'])->name('vendor.boq.store');
    Route::get('/vendor/categories', [VendorCategoryController::class, 'index'])->name('vendor.categories');
    Route::get('/vendor/category/{slug}', [VendorCategoryController::class, 'showForm'])->name('vendor.category.form');
    Route::post('/vendor/category/{slug}', [VendorCategoryController::class, 'saveForm'])->name('vendor.category.save');

    Route::get('/login', [VendorAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [VendorAuthController::class, 'loginSubmit'])->name('login.submit');

    Route::get('/dashboard', [VendorAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [VendorAuthController::class, 'logout'])->name('logout');
    Route::post('/vendor/register-submit', [VendorController::class, 'vendorstore'])->name('vendor.register.submit');

    Route::get('/vendor/password-setup', [VendorController::class, 'showPasswordSetupForm'])->name('vendor.password.setup.form');
    Route::post('/vendor/password-setup', [VendorController::class, 'savePassword'])->name('vendor.password.setup.save');

    Route::post('/vendor/check-mobile', [VendorController::class, 'checkMobile'])->name('vendor.check.mobile');

    Route::get('/vendor/login', [VendorController::class, 'showLoginForm'])->name('vendor.login.form');
    Route::post('/vendor/login', [VendorController::class, 'vendorLogin'])->name('vendor.login.submit');

    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    
    // Route::post('/vendor/send-otp', [VendorAuthController::class, 'sendOtp'])->name('vendor.sendOtp');
    // Route::post('/vendor/verify-otp', [VendorAuthController::class, 'verifyOtp'])->name('vendor.verifyOtp');

    Route::get('/vendor/dashboard', [VendorAuthController::class, 'vendor_dashboard'])->name('vendor.dashboard');

    Route::get('/survey/create', [SurveyController::class, 'create'])->name('survey.create');
    Route::post('/survey/store', [SurveyController::class, 'store'])->name('survey.store');

    Route::get('/category/na-support-legal', [NaLegalController::class, 'create'])->name('na_legal.create');
    Route::post('/na-legal/store', [NaLegalController::class, 'store'])->name('na_legal.store');

    Route::get('/fabrication-service/create', [FabricationServiceController::class, 'create'])->name('fabrication_service.create');
    Route::post('/fabrication-service/store', [FabricationServiceController::class, 'store'])->name('fabrication_service.store');

    Route::get('/category/structural-auditor-engineer', [StructuralAuditController::class, 'create'])->name('structural_audit.create');
    Route::post('/structural-audit/store', [StructuralAuditController::class, 'store'])->name('structural_audit.store');

    Route::get('/category/machinery-provider', [MachineryProviderController::class, 'create'])->name('machinery_provider.create');
    Route::post('/machinery-provider/store', [MachineryProviderController::class, 'store'])->name('machinery_provider.store');
    Route::get('/category/facade-services', [FacadeServicesController::class, 'create'])->name('facade_services.create');
    Route::post('/facade-services/store', [FacadeServicesController::class, 'store'])->name('facade_services.store');
     // Contractor
    Route::get('/category/contractor', [ContractorController::class, 'create'])->name('contractor.create');
    Route::post('/contractor/store', [ContractorController::class, 'store'])->name('contractor.store');

    // Surveyor
    Route::get('/category/surveyor', [SurveyorController::class, 'create'])->name('surveyor.create');
    Route::post('/surveyor/store', [SurveyorController::class, 'store'])->name('surveyor.store');

    // Architect
    Route::get('/category/architect', [ArchitectController::class, 'create'])->name('architect.create');
    Route::post('/architect/store', [ArchitectController::class, 'store'])->name('architect.store');


    Route::get('/vendor/category/interior', [InteriorController::class, 'create'])->name('interior.create');

    Route::post('/interior/store', [InteriorController::class, 'store'])->name('interior.store');

    Route::post('/testing-lab-agency/store', [TestingController::class, 'store'])->name('testinglabagency.store');

    Route::get('/vendor/notifications', [VendorController::class, 'notifications'])->name('vendor.notifications');

    Route::post('/vendor/notification-response', [VendorController::class, 'notificationResponse'])
    ->name('vendor.notification.response');
// 
// });


// Route::get('/', [CustomerController::class, 'welcome'])->name('welcome');
Route::post('/customer/send-otp', [CustomerController::class, 'sendOtp'])->name('customer.send.otp');
Route::post('/customer/verify-otp', [CustomerController::class, 'verifyOtp'])->name('customer.verify.otp');

Route::get('/customer/survey', [CustomerController::class, 'surveyPage'])->name('customer.survey');
Route::get('/customer/testing', [CustomerController::class, 'testingPage'])->name('customer.testing');

Route::get('/customer/boq', [CustomerController::class, 'boqPage'])->name('customer.boq');

Route::post('/customer/survey-booking/save', [CustomerController::class, 'saveSurveyBooking'])->name('customer.survey.booking.save');
Route::get('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');

Route::post('/testing-enquiry-store', [TestingEnquiryController::class, 'store'])->name('testing.enquiry.store');

Route::post('/boq-enquiry-store', [BoqEnquiryController::class, 'store'])->name('boq.enquiry.store');
Route::get('/customer/facade', [CustomerController::class, 'facadePage'])->name('customer.facade');

Route::post('/facade-enquiry-store', [FacadeEnquiryController::class, 'store'])->name('facade.enquiry.store');

Route::get('/customer/structuralaudit', [CustomerController::class, 'structuralaudit'])->name('customer.structuralaudit');
Route::post('/structural-audit-enquiry-store', [StructuralAuditEnquiryController::class, 'store'])->name('structural.audit.enquiry.store');

Route::get('/customer/nasupport', [CustomerController::class, 'nasupport'])->name('customer.nasupport');
Route::post('/na-support/store', [NaSupportController::class, 'store'])->name('na.support.store');

Route::get('/customer/welding-fabrication', [CustomerController::class, 'welding_fabrication'])->name('customer.welding_fabrication');

Route::post('/welding-fabrication/store', [WeldingFabricationController::class, 'store'])->name('welding.fabrication.store');


Route::get('/get-areas/{city_id}', [VendorCategoryController::class, 'getAreas'])->name('get.areas');
Route::get('/get-pincodes', [VendorCategoryController::class, 'getPincodes'])->name('get.pincodes');

Route::get('/post', [CustomerController::class, 'post'])->name('post');

Route::get('/post_for_interior', [CustomerController::class, 'post_for_interior'])->name('post_for_interior');


Route::post('/interior-requirement/store', [CustomerController::class, 'storeInteriorRequirement'])
    ->name('interior.requirement.store');
Route::get('/myorder', [CustomerController::class, 'myorder'])->name('myorder');
Route::get('/myorder/track/{service_key}/{source_id}', [CustomerController::class, 'track'])->name('myorder.track');

Route::post('/save-post', [CustomerController::class, 'savepost'])->name('save.post');
Route::get('/get-project-types/{workType}', [CustomerController::class, 'getProjectTypes']);

Route::get('help-center', [HomeController::class, 'helpcenter'])->name('helpcenter');
Route::post('/help-center/callback-submit', [HomeController::class, 'submitCallback'])
    ->name('help.callback.submit');

    
Route::get('knowledge-hub', [HomeController::class, 'knowledgehub'])->name('knowledgehub');
Route::get('construction-eduction', [HomeController::class, 'constructioneduction'])->name('constructioneduction');

Route::get('constructkaro-work', [HomeController::class, 'constwork'])->name('constwork');

Route::get('survey-services-step', [HomeController::class, 'surveyservicesstep'])->name('surveyservicesstep');
Route::get('testing-services-steps', [HomeController::class, 'testingservicessteps'])->name('testingservicessteps');


Route::get('na-legal-supportsteps', [HomeController::class, 'nasupportsteps'])->name('nasupportsteps');

Route::get('boq-services-supportsteps', [HomeController::class, 'boqservicessteps'])->name('boqservicessteps');
Route::get('facade-service-supportsteps', [HomeController::class, 'facadeservicesteps'])->name('facadeservicesteps');


Route::get('interior-designer-supportsteps', [HomeController::class, 'interiordesignersteps'])->name('interiordesignersteps');

Route::get('structural-audit-supportsteps', [HomeController::class, 'structuralauditsteps'])->name('structuralauditsteps');
Route::get('welding-and-fabrication-supportsteps', [HomeController::class, 'weldingandfabricationsteps'])->name('weldingandfabricationsteps');

Route::get('architect-supportsteps', [HomeController::class, 'architectsteps'])->name('architectsteps');
Route::get('contractor-supportsteps', [HomeController::class, 'contractorsteps'])->name('contractorsteps');

Route::get('choose-right-contractor', [HomeController::class, 'chooserightcontractor'])->name('chooserightcontractor');

Route::get('construction-article', [HomeController::class, 'constructionarticle'])->name('constructionarticle');

Route::get('different-consultant', [HomeController::class, 'differentconsultant'])->name('differentconsultant');

Route::get('blogs-insights', [HomeController::class, 'blogsinsights'])->name('blogsinsights');
Route::get('blogs-insights-page', [HomeController::class, 'blogsinsightspage'])->name('blogsinsightspage');


Route::get('about-us', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('our-baground', [HomeController::class, 'ourbaround'])->name('ourbaround');

Route::get('about-who-me', [HomeController::class, 'aboutwhome'])->name('aboutwhome');
Route::get('core-problem', [HomeController::class, 'coreproblem'])->name('coreproblem');

Route::get('canstructkaro-different', [HomeController::class, 'canstructkarodifferent'])->name('canstructkarodifferent');

Route::get('guide_me', [HomeController::class, 'guide_me'])->name('guide_me');

Route::get('architect-services', [HomeController::class, 'architect_services'])->name('architect.services');


Route::get('contractor-services', [HomeController::class, 'contractor_services'])->name('contractor.services');

Route::get('interior-services', [HomeController::class, 'interior_services'])->name('interior.services');

Route::get('survey-services', [HomeController::class, 'survey_services'])->name('survey.services');
Route::get('survey-testing', [HomeController::class, 'survey_testing'])->name('survey.testing');
Route::get('boq-testing', [HomeController::class, 'boq_testing'])->name('boq.testing');

Route::get('guide-me', [HomeController::class, 'confused_guide_me'])->name('confused_guide_me');


Route::post('/construction-requirement/store', [ConstructionRequirementController::class, 'store'])
    ->name('construction.requirement.store');


    // Route::get('/package-material/{package}', [HomeController::class, 'packageMaterial'])
    // ->name('package.material');

   Route::get('/package-material/{city}/{package}', [HomeController::class, 'packageMaterial'])
    ->name('package.material');

    Route::get('/turnkey-material/{city}', [HomeController::class, 'turnkeyMaterial'])
    ->name('turnkey.material');


    Route::get('/turnkey-material/{city}/{package}', [HomeController::class, 'turnkeyMaterial'])
    ->name('turnkey.material');
Route::get('/', [CustomerController::class, 'welcome'])->name('welcome');
Route::get('/check-services', [ServiceAvailabilityController::class, 'check']);
