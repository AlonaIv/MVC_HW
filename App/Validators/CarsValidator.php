<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class CarsValidator extends BaseValidator
{
    protected array $rules = [
        'park_id' => '/^\d+$/',
        'model' => '/[a-zA-Z0-9_]{2,}/',
        'year' => '/^\d{4,4}+$/',
        'price' => '/([0-9]*[.])?[0-9]+$/'
    ];

    protected array $errors = [
        'park_id' => 'ParkId should contain only 0-9',
        'model' => 'Model should contain only "a-z A-Z 0-9 _" and length should be more than 2 symbols',
        'year' => 'Year should contain only "0-9" and length should be 4 symbols',
        'price' => 'Price should contain only "0-9 ."'
    ];

}