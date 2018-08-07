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


class FevProject{

    public static function loadProjects($where, $order, $limit){

        return Db::table('fev_projects')
            ->where($where)
            ->orderBy($order)
            ->limit($limit)
            ->get();

    }
    public static function loadProject($where, $order){

        return Db::table('fev_projects')
            ->where($where)
            ->orderBy($order)
            ->limit(1)
            ->get();

    }

}