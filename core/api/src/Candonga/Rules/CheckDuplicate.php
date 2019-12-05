<?php

namespace Candonga\Rules;

use Candonga\Http\Requests\CustomerRequest;
use Illuminate\Contracts\Validation\Rule;

class CheckDuplicate implements Rule
{
    protected $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(CustomerRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $issns = collect($this->request->get('products'))
            ->where('issn', '<>', null)
            ->pluck('issn')->toArray();
        $issns = array_count_values($issns);

        if($issns[$value] > 1)
            return false;

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There are products with the same issn.';
    }
}
