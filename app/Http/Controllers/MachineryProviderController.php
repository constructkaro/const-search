<?php

namespace App\Http\Controllers  ;

use App\Http\Controllers\Controller;
use App\Models\MachineryProvider;
use App\Models\MachineryProviderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineryProviderController extends Controller
{
    public function create()
    {
        return view('vendor.category.machinery-provider');
    }

    public function store(Request $request)
    {
        $request->validate([
            'machinery_categories' => 'required|array|min:1',
            'machinery_categories.*' => 'string',

            'brand' => 'required|array|min:1',
            'brand.*' => 'nullable|string|max:150',

            'model' => 'required|array|min:1',
            'model.*' => 'nullable|string|max:150',

            'quantity' => 'required|array|min:1',
            'quantity.*' => 'nullable|integer|min:1',

            'capacity' => 'required|array|min:1',
            'capacity.*' => 'nullable|string|max:100',

            'rental_basis' => 'nullable|array',
            'rental_basis.*' => 'string',

            'minimum_rental_duration' => 'nullable|string|max:100',

            'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'aadhaar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'insurance_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ownership_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'machinery_photos' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'machinery_categories.required' => 'Please select at least one machinery category.',
            'brand.required' => 'Please add at least one machine detail row.',
        ]);

        DB::beginTransaction();

        try {
            $provider = new MachineryProvider();
            $provider->machinery_categories = $request->machinery_categories;
            $provider->operator_available = $request->has('operator_available') ? 1 : 0;
            $provider->breakdown_support = $request->has('breakdown_support') ? 1 : 0;
            $provider->night_shift_support = $request->has('night_shift_support') ? 1 : 0;
            $provider->availability_24x7 = $request->has('availability_24x7') ? 1 : 0;
            $provider->rental_basis = $request->rental_basis ?? [];
            $provider->minimum_rental_duration = $request->minimum_rental_duration;
            $provider->status = 'pending';

            if ($request->hasFile('gst_certificate')) {
                $provider->gst_certificate = $request->file('gst_certificate')->store('machinery/gst_certificate', 'public');
            }

            if ($request->hasFile('aadhaar_card')) {
                $provider->aadhaar_card = $request->file('aadhaar_card')->store('machinery/aadhaar_card', 'public');
            }

            if ($request->hasFile('company_profile')) {
                $provider->company_profile = $request->file('company_profile')->store('machinery/company_profile', 'public');
            }

            if ($request->hasFile('insurance_file')) {
                $provider->insurance_file = $request->file('insurance_file')->store('machinery/insurance', 'public');
            }

            if ($request->hasFile('ownership_proof')) {
                $provider->ownership_proof = $request->file('ownership_proof')->store('machinery/ownership_proof', 'public');
            }

            if ($request->hasFile('machinery_photos')) {
                $provider->machinery_photos = $request->file('machinery_photos')->store('machinery/photos', 'public');
            }

            $provider->save();

            if ($request->has('brand')) {
                foreach ($request->brand as $index => $brand) {
                    if (
                        !empty($brand) ||
                        !empty($request->model[$index] ?? null) ||
                        !empty($request->quantity[$index] ?? null) ||
                        !empty($request->capacity[$index] ?? null)
                    ) {
                        MachineryProviderItem::create([
                            'machinery_provider_id' => $provider->id,
                            'brand' => $brand,
                            'model' => $request->model[$index] ?? null,
                            'quantity' => $request->quantity[$index] ?? null,
                            'capacity' => $request->capacity[$index] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Machinery provider form submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}