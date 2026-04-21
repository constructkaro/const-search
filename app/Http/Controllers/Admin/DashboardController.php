<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        // dd($totalUsers);
        $totalAdmins = User::where('role', 'admin')->count();
        
        $totalSuperAdmins = User::where('role', 'super_admin')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalSuperAdmins'
        ));
    }

  
}