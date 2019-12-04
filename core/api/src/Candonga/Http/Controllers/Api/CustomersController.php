<?php namespace Candonga\Http\Controllers\Api;

use Candonga\Entities\Customer;
use Candonga\Http\Requests\CustomerRequest;
use Candonga\Http\Resources\CustomersCollection;
use Candonga\Http\Resources\Customer as CustomerResource;
use Candonga\Http\Responses\ApiResponse;

class CustomersController extends BaseController
{
    public function all()
    {
        return new CustomersCollection(Customer::paginate());
    }

    public function get($id)
    {
        return new CustomerResource(Customer::findOrFail($id));
    }

    public function products($id)
    {
        return new CustomerResource(Customer::findOrFail($id)
            ->load('products')
        );
    }

    public function put(CustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    public function post($id, CustomerRequest $request)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return new CustomerResource($customer);
    }

    public function delete($id)
    {
        Customer::findOrFail($id)->delete();

        return ApiResponse::response(true, [], 'The customer was deleted successfully');
    }

}

