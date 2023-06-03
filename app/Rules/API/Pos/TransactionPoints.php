<?php

namespace App\Rules\API\Pos;

use Illuminate\Contracts\Validation\InvokableRule;

class TransactionPoints implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ((int)$value > auth()->user()->pos_current_points) {
            $fail(__('Your points is not enough'));
        }
    }
}
