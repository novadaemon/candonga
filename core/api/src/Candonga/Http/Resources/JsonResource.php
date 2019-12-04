<?php namespace Candonga\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;

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