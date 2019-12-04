<?php namespace Candonga\Http\Controllers\Api;

use Candonga\Data\Entities\Customer;
use Candonga\Http\Resources\CustomersCollection;
use Candonga\Http\Resources\Customer as CustomerResource;

class CustomersController extends BaseController
{
    public function all()
    {
        return new CustomersCollection(Customer::paginate());
    }

    public function get($id)
    {
        return new CustomerResource(Customer::find($id));
    }

    public function products($id)
    {
        return new CustomerResource(Customer::find($id)
            ->load('products')
        );
    }

}

