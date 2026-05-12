<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users.index',compact('users'));
    }

    public function allprojects()
    {
        dd('test');
        return view('admin.project.allprojects');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:super_admin,admin,telecaller,engineer',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User added successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'super_admin') {
            return redirect()->back()->with('error', 'Super Admin cannot be deleted.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    // public function allvendors(Request $request)
    // {
    // //   dd($request);
    //     $cities = DB::table('city')
    //         ->select('id', 'name')
    //         ->orderBy('name', 'asc')
    //         ->get();

    
    //     $areaTable = 'area';

    //     $areas = DB::table($areaTable)
    //         ->select('id', 'name')
    //         ->orderBy('name', 'asc')
    //         ->get();

    
    //     $query = DB::table('vendor_register')
    //         ->select(
    //             'vendor_register.id',
    //             'vendor_register.full_name',
    //             'vendor_register.mobile',
    //             'vendor_register.email',
    //             'vendor_register.company_name',
    //             'vendor_register.city_ids',
    //             'vendor_register.area_ids',
    //             'vendor_register.business_address',
    //             'vendor_register.business_entity',
    //             'vendor_register.pincode'
    //         );

      
    //     if ($request->filled('city')) {
    //         $cityId = (string) $request->city;

    //         $query->where(function ($q) use ($cityId) {
    //             $q->whereJsonContains('city_ids', $cityId)
    //             ->orWhereJsonContains('city_ids', (int) $cityId);
    //         });
    //     }

    //     if ($request->filled('work_type')) {
    //         if ($request->work_type == 'Contractor') {
    //             $query->whereNotNull('contractor_id');
    //         }

    //         if ($request->work_type == 'Architect') {
    //             $query->whereNotNull('architect_id');
    //         }

    //         if ($request->work_type == 'Interior') {
    //             $query->whereNotNull('interior_id');
    //         }

    //         if ($request->work_type == 'Surveyor') {
    //             $query->whereNotNull('surveyor_id');
    //         }

    //         if ($request->work_type == 'BOQ') {
    //             $query->whereNotNull('boq_id');
    //         }
    //     }

       
    //     if ($request->filled('search')) {
    //         $search = $request->search;

    //         $query->where(function ($q) use ($search) {
    //             $q->where('full_name', 'like', '%' . $search . '%')
    //             ->orWhere('company_name', 'like', '%' . $search . '%')
    //             ->orWhere('mobile', 'like', '%' . $search . '%')
    //             ->orWhere('email', 'like', '%' . $search . '%');
    //         });
    //     }

    //     $allvendors = $query
    //         ->orderBy('vendor_register.id', 'desc')
    //         ->paginate(15);

    // //   dd($allvendors);
    //     $cityMap = $cities->pluck('name', 'id')->toArray();
    //     $areaMap = $areas->pluck('name', 'id')->toArray();

    //     $decodeIds = function ($value) {
    //         if (empty($value)) {
    //             return [];
    //         }

    //         if (is_array($value)) {
    //             return $value;
    //         }

    //         $decoded = json_decode($value, true);

    //         if (is_string($decoded)) {
    //             $decoded = json_decode($decoded, true);
    //         }

    //         if (is_array($decoded)) {
    //             return array_values(array_filter($decoded));
    //         }

    //         return array_values(array_filter(array_map('trim', explode(',', $value))));
    //     };

    //     $allvendors->getCollection()->transform(function ($vendor) use ($decodeIds, $cityMap, $areaMap) {
    //         $cityIds = $decodeIds($vendor->city_ids);
    //         $areaIds = $decodeIds($vendor->area_ids);

    //         $cityNames = [];
    //         foreach ($cityIds as $cityId) {
    //             if (isset($cityMap[$cityId])) {
    //                 $cityNames[] = $cityMap[$cityId];
    //             }
    //         }

    //         $areaNames = [];
    //         foreach ($areaIds as $areaId) {
    //             if (isset($areaMap[$areaId])) {
    //                 $areaNames[] = $areaMap[$areaId];
    //             }
    //         }

    //         $vendor->city = count($cityNames) ? implode(', ', $cityNames) : '-';
    //         $vendor->area = count($areaNames) ? implode(', ', $areaNames) : '-';

    //         $workTypes = [];

    //         if (!empty($vendor->contractor_id)) {
    //             $workTypes[] = 'Contractor';
    //         }

    //         if (!empty($vendor->architect_id)) {
    //             $workTypes[] = 'Architect';
    //         }

    //         if (!empty($vendor->interior_id)) {
    //             $workTypes[] = 'Interior';
    //         }

    //         if (!empty($vendor->surveyor_id)) {
    //             $workTypes[] = 'Surveyor';
    //         }

    //         if (!empty($vendor->boq_id)) {
    //             $workTypes[] = 'BOQ';
    //         }

    //         $vendor->work_type = count($workTypes) ? implode(', ', $workTypes) : '';

    //         return $vendor;
    //     });

    //     return view('admin.vendors.index', compact('allvendors', 'cities'));
    // }
public function allvendors(Request $request)
{
    $cities = DB::table('city')
        ->select('id', 'name')
        ->orderBy('name', 'asc')
        ->get();

    $areas = DB::table('area')
        ->select('id', 'name')
        ->orderBy('name', 'asc')
        ->get();

   
    $providerTables = [
        'Contractor' => 'contractor_providers',
        'Architect'  => 'architect_providers',
        'Interior'   => 'interior_providers',
        'Surveyor'   => 'surveyor_providers',
        'BOQ'        => 'boq_providers',
    ];

    $query = DB::table('vendor_register')
        ->select(
            'vendor_register.id','vendor_register.remark',
            'vendor_register.full_name',
            'vendor_register.mobile',
            'vendor_register.email',
            'vendor_register.company_name',
            'vendor_register.city_ids',
            'vendor_register.area_ids',
            'vendor_register.business_address',
            'vendor_register.business_entity',
            'vendor_register.pincode'
        )
        ->selectRaw("
            EXISTS (
                SELECT 1 FROM contractor_providers
                WHERE contractor_providers.vendor_id = vendor_register.id
                LIMIT 1
            ) as has_contractor
        ")
        ->selectRaw("
            EXISTS (
                SELECT 1 FROM architect_providers
                WHERE architect_providers.vendor_id = vendor_register.id
                LIMIT 1
            ) as has_architect
        ")
        ->selectRaw("
            EXISTS (
                SELECT 1 FROM interior_providers
                WHERE interior_providers.vendor_id = vendor_register.id
                LIMIT 1
            ) as has_interior
        ")
        ->selectRaw("
            EXISTS (
                SELECT 1 FROM surveyor_providers
                WHERE surveyor_providers.vendor_id = vendor_register.id
                LIMIT 1
            ) as has_surveyor
        ")
        ->selectRaw("
            EXISTS (
                SELECT 1 FROM boq_providers
                WHERE boq_providers.vendor_id = vendor_register.id
                LIMIT 1
            ) as has_boq
        ");

    if ($request->filled('city')) {
        $cityId = (string) $request->city;

        $query->where(function ($q) use ($cityId) {
            $q->whereJsonContains('city_ids', $cityId)
                ->orWhereJsonContains('city_ids', (int) $cityId);
        });
    }

    if ($request->filled('work_type')) {
        $workType = $request->work_type;

        if (isset($providerTables[$workType])) {
            $table = $providerTables[$workType];

            $query->whereExists(function ($subQuery) use ($table) {
                $subQuery->select(DB::raw(1))
                    ->from($table)
                    ->whereColumn($table . '.vendor_id', 'vendor_register.id');
            });
        }
    }

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('vendor_register.full_name', 'like', '%' . $search . '%')
                ->orWhere('vendor_register.company_name', 'like', '%' . $search . '%')
                ->orWhere('vendor_register.mobile', 'like', '%' . $search . '%')
                ->orWhere('vendor_register.email', 'like', '%' . $search . '%');
        });
    }

    $allvendors = $query
        ->orderBy('vendor_register.id', 'desc')
        ->paginate(15)
        ->withQueryString();

    $cityMap = $cities->pluck('name', 'id')->toArray();
    $areaMap = $areas->pluck('name', 'id')->toArray();

    $decodeIds = function ($value) {
        if (empty($value)) {
            return [];
        }

        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        if (is_array($decoded)) {
            return array_values(array_filter($decoded));
        }

        return array_values(array_filter(array_map('trim', explode(',', $value))));
    };

    $allvendors->getCollection()->transform(function ($vendor) use ($decodeIds, $cityMap, $areaMap) {
        $cityIds = $decodeIds($vendor->city_ids);
        $areaIds = $decodeIds($vendor->area_ids);

        $cityNames = [];
        foreach ($cityIds as $cityId) {
            if (isset($cityMap[$cityId])) {
                $cityNames[] = $cityMap[$cityId];
            }
        }

        $areaNames = [];
        foreach ($areaIds as $areaId) {
            if (isset($areaMap[$areaId])) {
                $areaNames[] = $areaMap[$areaId];
            }
        }

        $vendor->city = count($cityNames) ? implode(', ', $cityNames) : '-';
        $vendor->area = count($areaNames) ? implode(', ', $areaNames) : '-';

        $workTypes = [];

        if (!empty($vendor->has_contractor)) {
            $workTypes[] = 'Contractor';
        }

        if (!empty($vendor->has_architect)) {
            $workTypes[] = 'Architect';
        }

        if (!empty($vendor->has_interior)) {
            $workTypes[] = 'Interior';
        }

        if (!empty($vendor->has_surveyor)) {
            $workTypes[] = 'Surveyor';
        }

        if (!empty($vendor->has_boq)) {
            $workTypes[] = 'BOQ';
        }

        $vendor->work_type = count($workTypes) ? implode(', ', $workTypes) : '-';

        return $vendor;
    });

    return view('admin.vendors.index', compact('allvendors', 'cities', 'areas'));
}

    public function vendorForms($vendorId)
    {
        $vendor = DB::table('vendor_register')->where('id', $vendorId)->first();

        $contractor = DB::table('contractor_providers')->where('vendor_id', $vendorId)->first();
        $architect  = DB::table('architect_providers')->where('vendor_id', $vendorId)->first();
        $interior   = DB::table('interior_providers')->where('vendor_id', $vendorId)->first();
        $surveyor   = DB::table('surveyor_providers')->where('vendor_id', $vendorId)->first();
        $boq        = DB::table('boq_providers')->where('vendor_id', $vendorId)->first();

        return view('admin.vendors.forms', compact(
            'vendor',
            'contractor',
            'architect',
            'interior',
            'surveyor',
            'boq'
        ));
    }

    public function updateVendorRemark(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'remark' => 'nullable|string|max:2000',
        ]);

        DB::table('vendor_register')
            ->where('id', $id)
            ->update([
                'remark' => $request->remark,
            ]);

        return back()->with('success', 'Vendor remark updated successfully.');
    }
}
