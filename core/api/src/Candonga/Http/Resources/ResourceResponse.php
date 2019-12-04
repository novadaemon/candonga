<?php namespace Candonga\Http\Resources;

use Candonga\Http\Responses\ApiResponse;
use Illuminate\Http\Resources\Json\ResourceResponse as BaseResourceResponse;

/**
 *  Extends from Illuminate\Http\Resources\Json\ResourceResponse
 * to customize Response
 *
 * Class ResourceResponse
 * @package Candonga\Http\Resources
 */
class ResourceResponse extends BaseResourceResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        $data = $this->wrap(
            $this->resource->resolve($request),
            $this->resource->with($request),
            $this->resource->additional
        );

        $response = ApiResponse::response(
            true,
            $data,
            '',
            $this->calculateStatus()
        );

        return tap($response, function ($response) use ($request) {
            $response->original = $this->resource->resource;

            $this->resource->withResponse($request, $response);
        });
    }
}