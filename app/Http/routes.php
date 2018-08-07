<?php

use App\Http\Controllers\HomeController;

Route::auth();

Route::get('/', 'HomeController@index');