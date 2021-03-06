<?php namespace Candonga\Http\Responses;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse as BasePaginatedResourceResponse;

/**
 * Extends from Illuminate\Http\Resources\Json\PaginatedResourceResponse
 * to customize Response
 *
 * Class PaginatedResourceResponse
 * @package Candonga\Http\Resources
 */
class PaginatedResourceResponse extends BasePaginatedResourceResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {

        $data = $this->resource->resolve($request);

        $additional = array_merge_recursive(
            $this->paginationInformation($request),
            $this->resource->with($request),
            $this->resource->additional
        );

        $response = ApiResponse::response(true, $data, '', $this->calculateStatus(), $additional);

        return tap($response, function ($response) use ($request) {
            $response->original = $this->resource->resource->pluck('resource');

            $this->resource->withResponse($request, $response);
        });
    }
}