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


//vendor
// Route::domain('vendor.constructkaro.in')->group(function () {
    Route::get('/vendor', function () {
         return view('vendor.welcome');
    })->name('vendor');


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


Route::get('/post', [CustomerController::class, 'post'])->name('post');

Route::post('/save-post', [CustomerController::class, 'savepost'])->name('save.post');
Route::get('/get-project-types/{workType}', [CustomerController::class, 'getProjectTypes']);
Route::get('/', [CustomerController::class, 'welcome'])->name('welcome');
Route::get('/check-services', [ServiceAvailabilityController::class, 'check']);

