<?php namespace Candonga\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;
use Candonga\Http\Responses\ResourceResponse;

/**
 * Extends Illuminate\Http\Resources\Json\JsonResource to
 * add necessary methods
 *
 * Class JsonResource
 * @package Candonga\Http\Resources
 */
class JsonResource extends BaseJsonResource
{
    public function toResponse($request)
    {
        return (new ResourceResponse($this))->toResponse($request);
    }

    protected function hasIncludes($resource, $request)
    {
        return in_array(
                $resource,
                preg_split('/,/', $request->get('includes')
            )
        );
    }
}