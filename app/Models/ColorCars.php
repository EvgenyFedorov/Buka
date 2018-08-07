<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

Class ColorCars extends model{

    public function insertCar($array_excel, $cars_array, $user_id){

        //print_r($array_excel);

        $this->diller_id = $user_id;                          //ID диллера
        //$this->car_id = $array_excel['4'];                  //ID Автомобиля
        $this->model_id = $cars_array->cardb_id;              //ID Модели
        $this->model_name = $cars_array->model_name;          //Название модели
        $this->equipment_name = 1;                            //Комплектация
        //$this->existence = 1;                               //В наличии ли авто
        $this->price = 1;                                     //Цена
        $this->exterior_color = $cars_array->name;            //Цвет экстерьера
        $this->interior_color = 'Цвет';                       //Цвет интерьера
        //$this->price_color = 1;                             //Сумму за цвет
        //$this->status_action = 1;                           //Есть ли акция
        $this->internal_code = $cars_array->internal_code;    //Внутренний код

    }
    public static function getCarsDillerList($idDiller){

        return DB::table('cars')->where([
            ['diller_id', $idDiller]
        ])->get();

    }
    public static function getCarsDillerOne($idDiller, $idCar){

        return DB::table('cars')->where([
            ['diller_id', $idDiller],
            ['id', $idCar]
        ])->get();

    }
    public static function saveCarDiller($idDiller, $input){

        return DB::table('cars')
            ->where([
                ['diller_id', $idDiller],
                ['id', $input['id_car']]
            ])
            ->update([
                'model_name'     => $input['model_name'],
                'equipment_name' => $input['equipment_name'],
                'exterior_color' => $input['exterior_color'],
                'interior_color' => $input['interior_color'],
                'price'          => $input['price']
            ]);

    }

}