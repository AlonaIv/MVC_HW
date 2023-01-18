<?php

namespace App\Controllers\Admin;

use App\Models\Car;
use App\Models\Park;
use App\Validators\CarsValidator;
use Core\View;
use App\Services\CarsService;


class CarsController extends BaseController
{
    public function index()
    {
        $cars = Car::all();
        View::render('admin/cars/index', compact('cars'));
    }

    public function create()
    {
        View::render('admin/cars/create');
    }

    public function store()
    {
        $fields = filter_input_array(INPUT_POST, $_POST);
        $validator = new CarsValidator();
        $errors = [];
        if (CarsService::create($fields, $validator)) {
            redirect('admin/cars');
        }

        if (!CarsService::checkYear($fields['year'])) {
            $errors['year'] = 'Year should be from 1901 to now';
        }

        if (ctype_digit($fields['park_id'])) {
            if (!Park::find($fields['park_id'])) {
                $errors['park_id'] = 'ParkId isn\'t correct';
            }
        }

        View::render('admin/cars/create', $this->getErrors($fields, $validator, $errors));
    }

    public function destroy(int $id)
    {
        Car::find($id)->destroy();
        redirect('admin/cars');
    }
}