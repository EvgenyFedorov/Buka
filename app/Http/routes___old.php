<?php

use App\Task;
use Illuminate\Http\Request;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/profile', 'ProfileController@init');

Route::auth();

/*Route::group(array('prefix' => 'profile'), function () {

    Route::get('/', [
        'middleware' => 'auth',
        'uses' => 'ProfileController@init'
    ]);

});*/

// Адрес инициализации api сервиса для диллеров
/*Route::group(array('prefix' => 'api'), function (){

    // Метод get-cars Загружает список автомобилей, ранее загруженных в СУ диллера
    Route::group(array('prefix' => 'locator'), function (){

        // ID диллера - идентификатор загрузки списка автомобилей
        Route::group(array('prefix' => '{id_diller}'), function (){

            // Загружаем список по id диллера
            Route::get('/', [
                'as' => 'id_diller',
                'uses' => 'ApiController@loadDillerCars'
            ]);

            // Загружаем список по id диллера и параметрам color и equipment
            // /where?color=color_name&equipment=equipment_name
            Route::get('/where', [
                'as' => 'id_diller',
                'uses' => 'ApiController@loadDillerCarsWhere'
            ]);

        });

        // В случае отсутствия ID выгружаем полный список автомобилей
        Route::get('/', 'ApiController@loadAllCars');

    });

});

Route::group(array('prefix' => 'diller'), function () {

    Route::group(array('prefix' => 'loadbase'), function () {

        Route::get('', [
            'middleware' => 'auth',
            'uses' => 'UserController@excelAction'
        ]);

        Route::post('', array('as' => 'excel', 'uses' => 'UserController@loadExcel'));

    });

    Route::group(array('prefix' => 'edit'), function () {

        Route::get('{id_car}', [
            'middleware' => 'auth',
            'uses' => 'UserController@editCar'
        ]);

    });

    Route::group(array('prefix' => 'save'), function () {

        Route::post('', array('as' => 'excel', 'uses' => 'UserController@saveCar'));

    });

    Route::get('', [
        'middleware' => 'auth',
        'uses' => 'UserController@index'
    ]);

});*/

