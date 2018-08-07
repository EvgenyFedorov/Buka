<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 14.02.2018
 * Time: 20:51
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ErrorsController extends Controller {

    public static function getError($text){
        return view('errors.error-default', [
            'error_text' => $text,
        ]);

    }

}