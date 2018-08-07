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


class FevActivity{

    public static function loadActivities($where, $order){

        return Db::table('fev_activities_type')
            ->where($where)
            ->orderBy($order)
            ->get();

    }
    public static function loadSubActivities($where, $order){

        return Db::table('fev_sub_activities_type')
            ->where($where)
            ->orderBy($order)
            ->get();

    }
    public static function loadActivity($where, $order){

        return Db::table('fev_activities_type')
            ->where($where)
            ->orderBy($order)
            ->limit(1)
            ->get();

    }

}