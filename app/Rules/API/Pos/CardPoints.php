<?php

namespace App\Rules\API\Pos;

use App\Models\Card;
use Illuminate\Contracts\Validation\InvokableRule;

class CardPoints implements InvokableRule
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
        $card = Card::findOrFail($value);

        if ($card->points * request()->integer('count') > auth()->user()->pos_current_points) {
            $fail(__('Your Balance is not enough to create this type of cards'));
        }
    }
}
