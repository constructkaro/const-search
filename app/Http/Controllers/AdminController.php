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

    // public function allvendors(){
    //     $allvendors = DB::table('vendor_register')->get();
    //     dd($allvendors);
    //     return view('admin.vendors.index',compact('allvendors'));
    // }

//     public function allvendors(Request $request)
// {
//     $query = DB::table('contractor_providers')
//         ->join('vendor_register', 'contractor_providers.vendor_id', '=', 'vendor_register.id')
//         ->select(
//             'vendor_register.*',
//             'contractor_providers.*',
//             DB::raw("'Contractor' as work_type")
//         );

//     if ($request->filled('city')) {
//         $query->where('vendor_register.city', $request->city);
//     }

//     if ($request->filled('search')) {
//         $query->where(function ($q) use ($request) {
//             $q->where('vendor_register.full_name', 'like', '%' . $request->search . '%')
//               ->orWhere('vendor_register.company_name', 'like', '%' . $request->search . '%');
//         });
//     }

//     $allvendors = $query->orderBy('vendor_register.id', 'desc')->paginate(15);
//     dd($allvendors);
//     $cities = DB::table('vendor_register')
//         ->whereNotNull('city')
//         ->distinct()
//         ->orderBy('city')
//         ->pluck('city');

//     return view('admin.vendors.index', compact('allvendors', 'cities'));
// }

public function allvendors(Request $request)
{
    $query = DB::table('vendor_register')
        ->leftJoin('contractor_providers', 'vendor_register.id', '=', 'contractor_providers.vendor_id')
        ->leftJoin('architect_providers', 'vendor_register.id', '=', 'architect_providers.vendor_id')
        ->leftJoin('interior_providers', 'vendor_register.id', '=', 'interior_providers.vendor_id')
        ->leftJoin('surveyor_providers', 'vendor_register.id', '=', 'surveyor_providers.vendor_id')
        ->leftJoin('boq_providers', 'vendor_register.id', '=', 'boq_providers.vendor_id')
        ->select(
            'vendor_register.*',

            'contractor_providers.id as contractor_id',
            'architect_providers.id as architect_id',
            'interior_providers.id as interior_id',
            'surveyor_providers.id as surveyor_id',
            'boq_providers.id as boq_id',

            DB::raw("
                CONCAT_WS(', ',
                    CASE WHEN contractor_providers.id IS NOT NULL THEN 'Contractor' END,
                    CASE WHEN architect_providers.id IS NOT NULL THEN 'Architect' END,
                    CASE WHEN interior_providers.id IS NOT NULL THEN 'Interior' END,
                    CASE WHEN surveyor_providers.id IS NOT NULL THEN 'Surveyor' END,
                    CASE WHEN boq_providers.id IS NOT NULL THEN 'BOQ' END
                ) as work_type
            ")
        );

    if ($request->filled('city')) {
        $query->where('vendor_register.city', $request->city);
    }

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('vendor_register.full_name', 'like', '%' . $request->search . '%')
              ->orWhere('vendor_register.company_name', 'like', '%' . $request->search . '%')
              ->orWhere('vendor_register.mobile', 'like', '%' . $request->search . '%');
        });
    }

    $allvendors = $query
        ->orderBy('vendor_register.id', 'desc')
        ->paginate(15);

    $cities = DB::table('vendor_register')
        ->whereNotNull('city')
        ->distinct()
        ->orderBy('city')
        ->pluck('city');

    return view('admin.vendors.index', compact('allvendors', 'cities'));
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
}
