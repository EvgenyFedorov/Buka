<?php
namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

Class LoadCars extends model{

    // Загружаем автомобили по id диллера
    public  static function getDillerCars($idDiller){

        return DB::table('cars')->where('diller_id', $idDiller)->get();

    }
    public static function getWhereDillerCars($idDiller, $color, $equipment){

        return DB::table('cars')->where([
            ['diller_id', $idDiller],
            ['internal_code', $color],
            ['equipment_name', $equipment]
        ])->get();

    }
    // Загружаем все автомобили
    public  static function getAllCars(){

        return DB::table('cars')->orderBy('diller_id')->get();

    }

}