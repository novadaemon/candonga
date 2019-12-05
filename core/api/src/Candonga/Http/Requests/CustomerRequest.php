<?php

namespace Candonga\Http\Requests;

use Candonga\Rules\CheckDuplicate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'status' => 'nullable|in:new,pending,in review,approved,inactive,deleted',
            'products' => [
                'nullable',
                'array'
            ],
            'products.*.issn' => [
                'required',
                new CheckDuplicate($this)
            ],
            'products.*.name' => 'required',
            'products.*.status' => 'nullable|in:new,pending,in review,approved,inactive,deleted',
        ];
    }

    public function messages()
    {
        return [
            'products.*.issn.required' => "There are empty fields",
            'products.*.name.required' => "The are empty fields"
        ];
    }
}
