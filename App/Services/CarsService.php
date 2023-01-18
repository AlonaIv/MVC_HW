<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Park;
use App\Validators\CarsValidator;

class CarsService
{
    public static function create(array $fields, CarsValidator $validator): bool
    {
        if (!$validator->validate($fields) || !self::checkYear($fields['year']) || !Park::find($fields['park_id'])) {
            return false;
        }

        return (bool)Car::create($fields);
    }

    public static function checkYear(string $year): bool
    {
        if ($year <= 1900 || $year > date("Y")) {
            return false;
        }

        return true;
    }
}