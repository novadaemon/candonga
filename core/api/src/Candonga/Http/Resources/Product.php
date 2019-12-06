<?php

namespace Candonga\Http\Resources;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'issn' => $this->issn,
            'name' => $this->name,
            'status' => $this->status,
            'meta' => [
                'link' => url('api/products/'.$this->id)
            ],
            $this->mergeWhen($this->hasIncludes('customer', $request), [
                'customer' => new Customer($this->customer)
            ]),
        ];
    }
}