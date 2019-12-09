<?php namespace Candonga\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Candonga\Entities\Customer;
use Candonga\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;

class CustomersController extends BaseController
{
    public function index()
    {
        $records = Customer::all();

        return view('customers.list', compact('records'));
    }

    public function edit($id)
    {
        $record = Customer::findOrFail($id);

        return view('customers.form', compact('record'));
    }

    public function update($id, CustomerRequest $request)
    {
        $customer = Customer::findOrFail($id);

        if($customer){
            $customer->update($request->all());
            return redirect()->back()->with('success', 'Customer update successfully.');
        }

        return redirect()->back()->with('fail', 'Customer not found');
    }

    public function add()
    {
        $record = new Customer();

        return view('customers.form', compact('record'));
    }

    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        if($customer)
            return redirect()->route('customers.edit', $customer->id)
            ->with('success', 'Customer was inserted successfully.');

        return redirect()->back()->withInput()->with('fail', 'Han error has occurred. Try again.');
    }

    public function delete($id)
    {
        return response()->json(['success' => Customer::destroy($id)]);

    }
}

