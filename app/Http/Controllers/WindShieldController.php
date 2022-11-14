<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WindShield;
use Auth;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class WindShieldController extends Controller
{
    public function create(){
        return view('backend.wind_shield.create')
        ->withTitle('Input Kaca');
    }

    public function store(Request $request){
        Validator::extend('unique_windshield_brand',function($attribute,$value,$parameters,$validator) use($request){
            $count = DB::table('wind_shields')
                    ->where('wind_shield_brand_id',$value['value'])
                    ->where('wind_shield_part_id',$parameters[0])
                    ->where('car_type_id', $parameters[1])
                    ->count();
            return $count === 0;
        });
        $validator=Validator::make($request->all(),[
            'input_wind_shield_brand'=>"unique_windshield_brand:{$request->input('input_wind_shield_part')},{$request->input('input_car_type')['value']}"
            ]
            ,[
                'wind_shield_part_id.unique'=>'barang sudah ada'
            ]
        );

        dd($validator->errors());
        // $model = new WindShield;
        // $model->wind_shield_brand_id = $request->input('input_wind_shield_brand')['value'];
        // $model->wind_shield_part_id = $request->input('input_wind_shield_part');
        // $model->car_type_id = $request->input('input_car_type')['value'];
        // $model->price = $request->input('input_price');
        // $model->qty = $request->input('input_qty');
        // $model->user_id = Auth::user()->id;
        // $model->save();

        // foreach ($request->input_rack as $key => $value) {
        //     $model->rack()->attach($value["id"],["qty"=>$value["value"]]);
        // }

        // $model=WindShield::find(12);
        // return dd($model->rack->contains(1));

    }

    public function getWindShields(){
        $wind_shields = WindShield::with('rack','carType.car.brandCar','windshieldBrand','windshieldPart')->get();
        return $wind_shields;
    }
}
