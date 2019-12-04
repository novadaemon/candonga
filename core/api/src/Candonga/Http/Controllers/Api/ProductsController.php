<?php namespace Candonga\Http\Controllers\Api;

use Candonga\Data\Entities\Product;
use Candonga\Http\Resources\ProductsCollection;
use Candonga\Http\Resources\Product as ProductResource;

class ProductsController extends BaseController
{
    public function all()
    {
        return new ProductsCollection(Product::paginate());
    }

    public function get($id)
    {
        return new ProductResource(Product::find($id));
    }
}

