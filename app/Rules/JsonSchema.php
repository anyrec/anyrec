<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JsonSchema implements Rule
{
    private $validator;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->validator = new \JsonSchema\Validator;
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
        $this->validator->validate($data, (object)['$ref' => 'file://' . realpath('schema.json')]);

        return $this->validator->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = '';
        foreach ($this->validator->getErrors() as $error) {
            $message .= sprintf("[%s] %s\n", $error['property'], $error['message']);
        }
        return $message;
    }
}
