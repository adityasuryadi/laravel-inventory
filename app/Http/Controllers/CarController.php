<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Str;
use Auth;
use App\DataTables\CarDataTable;

class CarController extends Controller
{
    public function index(CarDataTable $dataTable){
        $title = 'List Mobil';
        return $dataTable->render('backend.cars.index',compact('title'));
    }

    public function create(){
        return view('backend.cars.create')
        ->withTitle('Input Mobil');
    }

    public function store(Request $request){
        $model = new Car;
        $model->id = Str::uuid();
        $model->name = $request->input('name');
        $model->year = $request->input('year');
        $model->user_id = Auth::user()->id;
        $model->brand_car_id = $request->input('brand_car_id');
        $model->save();

        $car_types=[];
        foreach (json_decode($request->input('car_type')) as $key => $value) {
            array_push($car_types,['name' => $value->name]);
        }

        // dd($car_types);

        $model->carType()->createMany($car_types);
    }

}
