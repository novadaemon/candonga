<?php

namespace Candonga\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckDuplicate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $issns = collect($value)->pluck('issn')->all();

        if(count(array_unique($issns))< count($issns))
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
