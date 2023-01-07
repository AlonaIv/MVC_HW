<?php

namespace App\Controllers;

use App\Models\Car;
use Core\Controller;

class ParksController extends Controller
{
    public function show(int $id)
    {
        d("id: ".$id);
//        d(Car::select(['model', 'year'])->get());
//        d(Car::all());
//        Car::create([
//            'park_id' => 1,
//            'model' => 'Renault',
//            'year' => 2003,
//            'price' => 34.43
//        ]);
//        d(Car::select(['model', 'year'])->where('id', '=', $id)->get());
    }
}