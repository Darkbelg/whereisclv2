<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmptyArray implements Rule
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
        $array = array_filter($value);
        
        if(count($array) !== count(array_unique($array))){
            return false;
        }

        if(count($array) <= 0){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'All ids need to be unique. At least one needs to be filled in.';
    }
}
