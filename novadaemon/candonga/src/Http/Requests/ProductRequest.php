<?php

namespace Candonga\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'issn' => 'required|unique:products,issn,'.$this->get('id'),
            'name' => 'required',
            'status' => 'nullable|in:new,pending,in review,approved,inactive,deleted'
        ];
    }
}
