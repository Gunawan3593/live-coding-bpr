<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();

        return view('customers.index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('customers.create'); 
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|min:3|max:25'
        ]);

        Customer::create($formFields);

        return redirect('/customers')->with('message', 'Customer created successfully!');
    }

    public function edit(Customer $customer) {
        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $formFields = $request->validate([
            'name' => 'required|min:3|max:25'
        ]);

        $customer->update($formFields);

        return redirect('/customers')->with('message', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return redirect('/customers')->with('message', 'Customer deleted successfully!');
    }
}
