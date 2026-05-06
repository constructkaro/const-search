<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InteriorProvider;


class InteriorController extends Controller
{
    public function create()
    {
        return view('vendor.category.interior-registration');
    }
public function store(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return redirect()->route('login')->with('error', 'Login required');
    }

    $request->validate([
        'project_types' => 'required|array',
        'project_types.*' => 'string',

        'experience_years' => 'nullable',
        'team_size' => 'nullable',

        'city_ids' => 'required|array|min:1',
        'city_ids.*' => 'required',

        'area_ids' => 'required|array|min:1',
        'area_ids.*' => 'required',

        'pincode' => 'required|string',

        'company_name' => 'required|string',
        'minimum_project_value' => 'required|numeric|min:0',
        'registered_address' => 'required|string',
        'contact_person_name' => 'nullable|string',
        'contact_person_designation' => 'nullable|string',

        'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
        'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
        'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
        'supporting_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:20480',
        'portfolio_images.*' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',

        'agreement_terms_accepted' => 'nullable',
        'privacy_policy_accepted' => 'nullable',
        'newsletter_opt_in' => 'nullable',
        'agreement_accepted_at' => 'nullable',
    ]);

    $existing = InteriorProvider::where('vendor_id', $vendorId)->first();

    $panCardPath = $existing?->pan_card;
    if ($request->hasFile('pan_card')) {
        $panCardPath = $request->file('pan_card')->store('interior/pan-card', 'public');
    }

    $gstCertificatePath = $existing?->gst_certificate;
    if ($request->hasFile('gst_certificate')) {
        $gstCertificatePath = $request->file('gst_certificate')->store('interior/gst-certificate', 'public');
    }

    $companyProfilePath = $existing?->company_profile;
    if ($request->hasFile('company_profile')) {
        $companyProfilePath = $request->file('company_profile')->store('interior/company-profile', 'public');
    }

    $supportingDocumentsPath = $existing?->supporting_documents;
    if ($request->hasFile('supporting_documents')) {
        $supportingDocumentsPath = $request->file('supporting_documents')->store('interior/supporting-documents', 'public');
    }

    $portfolioImage1 = $existing?->portfolio_image_1;
    $portfolioImage2 = $existing?->portfolio_image_2;
    $portfolioImage3 = $existing?->portfolio_image_3;

    if ($request->hasFile('portfolio_images')) {
        $portfolioImages = $request->file('portfolio_images');

        if (isset($portfolioImages[0])) {
            $portfolioImage1 = $portfolioImages[0]->store('interior/portfolio', 'public');
        }

        if (isset($portfolioImages[1])) {
            $portfolioImage2 = $portfolioImages[1]->store('interior/portfolio', 'public');
        }

        if (isset($portfolioImages[2])) {
            $portfolioImage3 = $portfolioImages[2]->store('interior/portfolio', 'public');
        }
    }

    $agreementAcceptedAt = null;

    if ($request->filled('agreement_accepted_at')) {
        $agreementAcceptedAt = \Carbon\Carbon::parse($request->agreement_accepted_at)
            ->timezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
    } else {
        $agreementAcceptedAt = now()->format('Y-m-d H:i:s');
    }

    InteriorProvider::updateOrCreate(
        ['vendor_id' => $vendorId],
        [
            'project_types' => $request->project_types,
            'experience_years' => $request->experience_years,
            'team_size' => $request->team_size,

            'city_ids' => $request->city_ids,
            'area_ids' => $request->area_ids,
            'pincode' => $request->pincode,

            'minimum_project_value' => $request->minimum_project_value,

            'company_name' => $request->company_name,
            'entity_type' => $request->entity_type,
            'registered_address' => $request->registered_address,
            'contact_person_designation' => $request->contact_person_designation,
            'contact_person_name' => $request->contact_person_name,

            'pan_number' => $request->pan_number,
            'gst_number' => $request->gst_number,

            'pan_card' => $panCardPath,
            'gst_certificate' => $gstCertificatePath,
            'company_profile' => $companyProfilePath,
            'supporting_documents' => $supportingDocumentsPath,

            'portfolio_image_1' => $portfolioImage1,
            'portfolio_image_2' => $portfolioImage2,
            'portfolio_image_3' => $portfolioImage3,

            'agreement_terms_accepted' => $request->agreement_terms_accepted,
            'privacy_policy_accepted' => $request->privacy_policy_accepted,
            'newsletter_opt_in' => $request->newsletter_opt_in ?? 0,
            'agreement_accepted_at' => $agreementAcceptedAt,
        ]
    );

    return back()->with('success', 'Data saved successfully');
}
 
//  public function store(Request $request)
// {
//     $vendorId = session('vendor_id');

//     if (!$vendorId) {
//         return redirect()->route('login')->with('error', 'Login required');
//     }

//     $request->validate([
//         'project_types' => 'required|array',
//         'project_types.*' => 'string',
//         'experience_years' => 'nullable',
//         'team_size' => 'nullable',
//         'company_name' => 'required|string',
//         'minimum_project_value' => 'required',
//         'registered_address' => 'required|string',
//         'contact_person_name' => 'nullable|string',
//         'contact_person_designation' => 'nullable|string',
//         'city_ids' => 'required',
//         'area_ids' => 'required|array',
//         'pincode' => 'required',
//         'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
//         'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
//         'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
//         'supporting_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
//         'portfolio_images.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',

//           'agreement_terms_accepted' => 'required|accepted',
//         'privacy_policy_accepted'  => 'required|accepted',
//         'newsletter_opt_in'        => 'nullable',
//         'agreement_accepted_at'    => 'nullable|string',
//     ]);

//     $existing = InteriorProvider::where('vendor_id', $vendorId)->first();

//     $panCardPath = $existing?->pan_card;
//     if ($request->hasFile('pan_card')) {
//         $panCardPath = $request->file('pan_card')->store('interior/pan-card', 'public');
//     }

//     $gstCertificatePath = $existing?->gst_certificate;
//     if ($request->hasFile('gst_certificate')) {
//         $gstCertificatePath = $request->file('gst_certificate')->store('interior/gst-certificate', 'public');
//     }

//     $companyProfilePath = $existing?->company_profile;
//     if ($request->hasFile('company_profile')) {
//         $companyProfilePath = $request->file('company_profile')->store('interior/company-profile', 'public');
//     }

//     $supportingDocumentsPath = $existing?->supporting_documents;
//     if ($request->hasFile('supporting_documents')) {
//         $supportingDocumentsPath = $request->file('supporting_documents')->store('interior/supporting-documents', 'public');
//     }

//     $portfolioImage1 = $existing?->portfolio_image_1;
//     $portfolioImage2 = $existing?->portfolio_image_2;
//     $portfolioImage3 = $existing?->portfolio_image_3;

//     if ($request->hasFile('portfolio_images')) {
//         $portfolioImages = $request->file('portfolio_images');

//         if (isset($portfolioImages[0])) {
//             $portfolioImage1 = $portfolioImages[0]->store('interior/portfolio', 'public');
//         }

//         if (isset($portfolioImages[1])) {
//             $portfolioImage2 = $portfolioImages[1]->store('interior/portfolio', 'public');
//         }

//         if (isset($portfolioImages[2])) {
//             $portfolioImage3 = $portfolioImages[2]->store('interior/portfolio', 'public');
//         }
//     }

//     InteriorProvider::updateOrCreate(
//         ['vendor_id' => $vendorId],
//         [
//             'project_types' => $request->project_types,
//             'experience_years' => $request->experience_years,
//             'team_size' => $request->team_size,
//             'city_ids' => $request->city_ids,
//             'area_ids' => $request->area_ids,
//             'pincode' => $request->pincode,
//             'minimum_project_value' => $request->minimum_project_value,

//             'company_name' => $request->company_name,
//             'entity_type' => $request->entity_type,
//             'registered_address' => $request->registered_address,
//             'contact_person_designation' => $request->contact_person_designation,
//             'contact_person_name' => $request->contact_person_name,

//             'pan_number' => $request->pan_number,
//             'gst_number' => $request->gst_number,
         
//             'pan_card' => $panCardPath,
//             'gst_certificate' => $gstCertificatePath,
//             'company_profile' => $companyProfilePath,
//             'supporting_documents' => $supportingDocumentsPath,

//             'portfolio_image_1' => $portfolioImage1,
//             'portfolio_image_2' => $portfolioImage2,
//             'portfolio_image_3' => $portfolioImage3,

//              'agreement_terms_accepted' => $request->agreement_terms_accepted,
//         'privacy_policy_accepted'  => $request->privacy_policy_accepted,
//         'newsletter_opt_in'        => $request->newsletter_opt_in ?? 0,
//         'agreement_accepted_at'    => $request->agreement_accepted_at,
//         ]
//     );

//     return back()->with('success', 'Data saved successfully');
// }
}