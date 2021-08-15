<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CommandsRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $commands = str_split($value, 1);
        foreach ($commands as $command) {
            if (! in_array($command, AVAILABLE_COMMANDS)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute has invalid command.';
    }
}
