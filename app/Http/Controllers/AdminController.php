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

    public function allvendors(){
        $allvendors = DB::table('vendor_register')->get();
        // dd($allvendors);
        return view('admin.vendors.index',compact('allvendors'));
    }
}
