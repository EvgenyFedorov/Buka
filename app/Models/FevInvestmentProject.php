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


class FevInvestmentProject{

    public static function loadProjectsInPage($where, $order, $limit){

        return Db::table('fev_investor_proj')
            ->leftJoin('fev_user_info', 'fev_investor_proj.id_user_investor_proj', '=', 'fev_user_info.id_user_info')
            ->leftJoin('fev_activities_type', 'fev_investor_proj.id_investor_activity', '=', 'fev_activities_type.id_activitie')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get();

    }
    public static function loadProjectsInPageOne($where, $order){

        return Db::table('fev_investor_proj')
            ->leftJoin('fev_user_info', 'fev_investor_proj.id_user_investor_proj', '=', 'fev_user_info.id_user_info')
            ->leftJoin('fev_activities_type', 'fev_investor_proj.id_investor_activity', '=', 'fev_activities_type.id_activitie')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(1)
            ->get();

    }
    public static function loadProjectsPhone($where, $order){

        return Db::table('fev_investor_proj')
            ->select('fev_user_info.phone_investor_proj', 'fev_investor_proj.feedbacks_investor_proj')
            ->leftJoin('fev_user_info', 'fev_investor_proj.id_user_investor_proj', '=', 'fev_user_info.id_user_info')
            ->leftJoin('fev_activities_type', 'fev_investor_proj.id_investor_activity', '=', 'fev_activities_type.id_activitie')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(1)
            ->get();

    }
    public static function loadProjectsForDialog($where, $order){

        return Db::table('fev_investor_proj')
            ->select('fev_user_info.id_user_info')
            ->leftJoin('fev_user_info', 'fev_investor_proj.id_user_investor_proj', '=', 'fev_user_info.id_user_info')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(1)
            ->get();

    }
    public static function loadProjects($where, $order, $limit){

        return Db::table('fev_investor_proj')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(500)
            ->get();

    }
    public static function loadCountProjects($where){

        return Db::table('fev_investor_proj')
            ->where($where)
            ->count();

    }
    public static function loadProject($where, $order){

        return Db::table('fev_investor_proj')
            ->where($where)
            ->orderBy($order)
            ->limit(1)
            ->get();

    }
    public static function addProject($data){

        return DB::table('fev_investor_proj')->insertGetId([
            'id_user_investor_proj'      => $data['id_user'],
            'id_investor_activity'       => $data['activity'],
            'id_investor_sub_activities' => $data['sub_activity'],
            'sum_investor_proj'          => $data['sum_invest'],
            'feedbacks_investor_proj'    => 0,
            'views_investor_proj'        => 0,
            'country_investor_proj'      => 0,
            'city_investor_proj'         => 0,
            'phone_investor_proj'        => (!empty($data['dop_phone']) ? $data['dop_phone'] : 0),
            'email_investor_proj'        => (!empty($data['dop_email']) ? $data['dop_email'] : 0),
            'status_investor_proj'       => 0,
            'type_investor_proj'         => 0,
            'notification_investor_proj' => (!empty($data['notification']) ? 1 : 0),
            'img_investor_proj'          => $data['load_img'],
            'title_investor_proj'        => $data['name_advert'],
            'h1_investor_proj'           => $data['name_advert'],
            'desc_investor_proj'         => strip_tags($data['mini_desc']),
            'text_investor_proj'         => $data['full_desc'],
            'created_at_investor_proj'   => date("Y-m-d H:i:s"),
            'updated_at_investor_proj'   => date("Y-m-d H:i:s")
        ]);

    }
    public static function updateProject($data){

        return DB::table('fev_investor_proj')
            ->where([
                ['id_investor_proj', $data['id_advert']],
                ['id_user_investor_proj', $data['id_user']],
            ])
            ->update([
                'sum_investor_proj'          => $data['sum_invest'],
                'phone_investor_proj'        => (!empty($data['dop_phone']) ? $data['dop_phone'] : 0),
                'email_investor_proj'        => (!empty($data['dop_email']) ? $data['dop_email'] : 0),
                'notification_investor_proj' => (!empty($data['notification']) ? 1 : 0),
                'img_investor_proj'          => $data['load_img'],
                'title_investor_proj'        => $data['name_advert'],
                'h1_investor_proj'           => $data['name_advert'],
                'desc_investor_proj'         => strip_tags($data['mini_desc']),
                'text_investor_proj'         => $data['full_desc'],
                'updated_at_investor_proj'   => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectImg($data){

        return DB::table('fev_investor_proj')
            ->where([
                ['id_investor_proj', $data['id_advert']],
                ['id_user_investor_proj', $data['id_user']],
            ])
            ->update([
                'img_investor_proj'          => $data['load_img'],
                'updated_at_investor_proj'   => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectStatus($data){

        return DB::table('fev_investor_proj')
            ->where([
                ['id_investor_proj', $data['id_advert']],
                ['id_user_investor_proj', $data['id_user']],
            ])
            ->update([
                'status_investor_proj'       => $data['status'],
                'type_investor_proj'         => !isset($data['type_adverts']) ? 0 : $data['type_adverts'],
                'updated_at_investor_proj'   => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectFeedBack($data){

        return DB::table('fev_investor_proj')
            ->where([
                ['id_investor_proj', $data['id_advert']],
            ])
            ->update([
                'feedbacks_investor_proj'  => $data['feedbacks'],
                'updated_at_investor_proj' => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectViews($data){

        return DB::table('fev_investor_proj')
            ->where([
                ['id_investor_proj', $data['id_advert']],
            ])
            ->update([
                'views_investor_proj'      => $data['views'],
                'updated_at_investor_proj' => date("Y-m-d H:i:s")
            ]);

    }
    public static function getCountObjects($objects){

        $count_obj = 0;

        foreach ($objects as $object){

            $count_obj++;

        }

        return $count_obj;

    }

}