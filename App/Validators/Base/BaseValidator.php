<?php

namespace App\Validators\Base;

class BaseValidator
{
    protected array $errors = [], $rules = [];

    public function validate(array $fields): bool
    {
        foreach ($fields as $key => $value) {
//            d('key: '.$key, 'value: '.$value, 'preg: '.$this->rules[$key], 'preg_match: '.preg_match($this->rules[$key], $value));
            if (!empty($this->rules[$key]) && preg_match($this->rules[$key], $value)) {
                unset($this->errors[$key]);
            }
        }
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}