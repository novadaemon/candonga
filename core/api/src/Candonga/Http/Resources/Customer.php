<?php

namespace Candonga\Http\Resources;

class Customer extends JsonResource
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
            'uuid' => $this->uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth->format('Y-m-d'),
            'status' => $this->status,
            'products' => Product::collection($this->whenLoaded('products'))
        ];
    }

}