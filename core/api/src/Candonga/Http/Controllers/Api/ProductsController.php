<?php namespace Candonga\Http\Controllers\Api;

use Candonga\Data\Entities\Product;
use Candonga\Http\Requests\ProductRequest;
use Candonga\Http\Resources\ProductsCollection;
use Candonga\Http\Resources\Product as ProductResource;
use Candonga\Http\Responses\ApiResponse;

class ProductsController extends BaseController
{
    public function all()
    {
        return new ProductsCollection(Product::paginate());
    }

    public function get($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function put(ProductRequest $request)
    {
        return new ProductResource(Product::create($request->all()));
    }

    public function post($id, ProductRequest $request)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return new ProductResource($product);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return ApiResponse::response(true, [], 'The product was deleted successfully');
    }
}

