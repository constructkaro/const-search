<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerManagementController extends Controller
{
    public function index(Request $request)
    {
        $customers = DB::table('customers')
            ->leftJoin('posts', 'customers.id', '=', 'posts.user_id')
            ->select('customers.id', 'customers.name', 'customers.mobile', 'customers.email')
            ->selectRaw('customers.password IS NOT NULL as has_password')
            ->selectRaw('COUNT(posts.id) as projects_count')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->where(function ($query) use ($search) {
                    $query->where('customers.name', 'like', '%'.$search.'%')
                        ->orWhere('customers.mobile', 'like', '%'.$search.'%')
                        ->orWhere('customers.email', 'like', '%'.$search.'%');
                });
            })
                ->groupBy('customers.id', 'customers.name', 'customers.mobile', 'customers.email', 'customers.password')
            ->orderByDesc('customers.id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.customers.index', [
            'customers' => $customers,
            'editingCustomer' => null,
        ]);
    }

    public function edit(Customer $customer)
    {
        $customers = DB::table('customers')
            ->leftJoin('posts', 'customers.id', '=', 'posts.user_id')
            ->select('customers.id', 'customers.name', 'customers.mobile', 'customers.email')
            ->selectRaw('customers.password IS NOT NULL as has_password')
            ->selectRaw('COUNT(posts.id) as projects_count')
            ->groupBy('customers.id', 'customers.name', 'customers.mobile', 'customers.email', 'customers.password')
            ->orderByDesc('customers.id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.customers.index', compact('customers', 'customer') + [
            'editingCustomer' => $customer,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:10'],
            'email' => ['nullable', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $customer = Customer::where('mobile', $validated['mobile'])->first();

        if ($validated['email'] && Customer::where('email', $validated['email'])
            ->when($customer, fn ($query) => $query->where('id', '!=', $customer->id))
            ->exists()) {
            return back()->withErrors(['email' => 'This email address is already used by another customer.'])
                ->withInput($request->except(['password', 'password_confirmation']));
        }

        $customer ??= new Customer();
        $customer->fill([
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'] ?: $customer?->email,
            'password' => Hash::make($validated['password']),
        ])->save();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer account saved. They can sign in at /customer/login using the mobile number and password you set.');
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:10', 'unique:customers,mobile,'.$customer->id],
            'email' => ['nullable', 'email', 'max:255', 'unique:customers,email,'.$customer->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $customer->fill([
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'] ?: null,
            'password' => Hash::make($validated['password']),
        ])->save();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer login updated. The existing customer and their projects are unchanged.');
    }
}