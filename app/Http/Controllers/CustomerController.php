<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $archived = $request->input('archived');

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'ILIKE', "%{$search}%")
                    ->orWhere('number', 'ILIKE', "%{$search}%");
                });
            })
            ->when($archived !== null, function ($query) use ($archived) {
                $query->where('is_archived', (bool) $archived);
            })
            ->when($archived === null, function ($query) {
                $query->where('is_archived', false);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->only(['search', 'archived']));

        return view('pages.customers.index', compact('customers', 'search', 'archived'));
    }

    public function overview(Customer $customer)
    {
        return view('pages.customers.overview', compact('customer'));
    }




    public function edit(Customer $customer)
    {
        // $sites = Site::all();
        // $customer->load('sites');
        
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->get();

        return view('pages.customers.edit', compact('customer', 'users'));
    }
}