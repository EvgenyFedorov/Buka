<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 11.02.2018
 * Time: 15:46
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class FevDialog{

    public static function loadDialogs($where, $order, $limit){

        return Db::table('fev_dialog')
            ->where($where)
            ->orderBy($order)
            ->limit($limit)
            ->get();

    }
    public static function loadDialog($where, $order){

        return Db::table('fev_dialog')
            ->where($where)
            ->orderBy($order)
            ->limit(1)
            ->get();

    }

}