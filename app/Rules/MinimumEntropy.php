<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinimumEntropy implements Rule
{
    /**
     * Calculate the given string's entropy using the sum of the formula
     * p(i)*log2(1/p(i)), where p(i) is the frequency of a character in the
     * string divided by the string's character length.
     *
     * @param string $value
     */
    public static function calculate($value): float
    {
        $length = strlen($value);
        if (!$length) {
            return 0;
        }
        // Map characters to their counts
        $charCounts = [];
        for ($i = 0; $i < $length; $i++) {
            if (isset($charCounts[$value[$i]])) {
                $charCounts[$value[$i]] += 1;
            } else {
                $charCounts[$value[$i]] = 1;
            }
        }
        return array_sum(array_map(function ($charCount) use ($length) {
            $frequency = $charCount / $length;
            return $frequency * log(1 / $frequency, 2);
        }, $charCounts));
    }

    /**
     * @param int|float $minimum
     */
    public function __construct($minimum)
    {
        if (!(is_int($minimum) || is_float($minimum))) {
            throw new InvalidArgumentException(
                'The minimum entropy value must be an integer or a floating point number.'
            );
        }
        $this->minimum = $minimum;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return self::calculate($value) >= $this->minimum;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute is insufficiently complex. '
            . 'Try making it longer or using a greater variety of characters.';
    }
}
