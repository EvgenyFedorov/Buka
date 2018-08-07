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


class FevBusinessmanProject{

    public static function loadProjectsInPage($where, $order, $limit){

        return Db::table('fev_business_proj')
            ->leftJoin('fev_user_info', 'fev_business_proj.id_user_business_proj', '=', 'fev_user_info.id_user_info')
            ->leftJoin('fev_activities_type', 'fev_business_proj.id_business_activity', '=', 'fev_activities_type.id_activitie')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get();

    }
    public static function loadProjectsInPageOne($where, $order){

        return Db::table('fev_business_proj')
            ->leftJoin('fev_user_info', 'fev_business_proj.id_user_business_proj', '=', 'fev_user_info.id_user_info')
            ->leftJoin('fev_activities_type', 'fev_business_proj.id_business_activity', '=', 'fev_activities_type.id_activitie')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(1)
            ->get();

    }
    public static function loadProjectsPhone($where, $order){

        return Db::table('fev_business_proj')
            ->select('fev_user_info.phone_business_proj', 'fev_business_proj.feedbacks_business_proj')
            ->leftJoin('fev_user_info', 'fev_business_proj.id_user_business_proj', '=', 'fev_user_info.id_user_info')
            ->leftJoin('fev_activities_type', 'fev_business_proj.id_business_activity', '=', 'fev_activities_type.id_activitie')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(1)
            ->get();

    }
    public static function loadProjectsForDialog($where, $order){

        return Db::table('fev_business_proj')
            ->select('fev_user_info.id_user_info')
            ->leftJoin('fev_user_info', 'fev_business_proj.id_user_business_proj', '=', 'fev_user_info.id_user_info')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(1)
            ->get();

    }
    public static function loadProjects($where, $order, $limit){

        return Db::table('fev_business_proj')
            ->where($where)
            ->orderBy($order, 'desc')
            ->limit(500)
            ->get();

    }
    public static function loadCountProjects($where){

        return Db::table('fev_business_proj')
            ->where($where)
            ->count();

    }
    public static function loadProject($where, $order){

        return Db::table('fev_business_proj')
            ->where($where)
            ->orderBy($order)
            ->limit(1)
            ->get();

    }
    public static function addProject($data){

        return DB::table('fev_business_proj')->insertGetId([
            'id_user_business_proj'      => $data['id_user'],
            'id_business_activity'       => $data['activity'],
            'id_business_sub_activities' => $data['sub_activity'],
            'sum_business_proj'          => $data['sum_invest'],
            'profit_sum_business_proj'   => $data['sum_profit'],
            'm_turn_sum_business_proj'   => $data['sum_turn'],
            'm_expe_sum_business_proj'   => $data['sum_expe'],
            'proportion_business_proj'   => $data['sum_proportion'],
            'feedbacks_business_proj'    => 0,
            'views_business_proj'        => 0,
            'country_business_proj'      => 0,
            'city_business_proj'         => 0,
            'phone_business_proj'        => (!empty($data['dop_phone']) ? $data['dop_phone'] : 0),
            'email_business_proj'        => (!empty($data['dop_email']) ? $data['dop_email'] : 0),
            'status_business_proj'       => 0,
            'type_business_proj'         => 0,
            'notification_business_proj' => (!empty($data['notification']) ? 1 : 0),
            'img_business_proj'          => $data['load_img'],
            'title_business_proj'        => $data['name_advert'],
            'h1_business_proj'           => $data['name_advert'],
            'desc_business_proj'         => strip_tags($data['mini_desc']),
            'text_business_proj'         => $data['full_desc'],
            'created_at_business_proj'   => date("Y-m-d H:i:s"),
            'updated_at_business_proj'   => date("Y-m-d H:i:s")
        ]);

    }
    public static function updateProject($data){

        return DB::table('fev_business_proj')
            ->where([
                ['id_business_proj', $data['id_advert']],
                ['id_user_business_proj', $data['id_user']],
            ])
            ->update([
                'sum_business_proj'          => $data['sum_invest'],
                'profit_sum_business_proj'   => $data['sum_profit'],
                'm_turn_sum_business_proj'   => $data['sum_turn'],
                'm_expe_sum_business_proj'   => $data['sum_expe'],
                'proportion_business_proj'   => $data['sum_proportion'],
                'phone_business_proj'        => (!empty($data['dop_phone']) ? $data['dop_phone'] : 0),
                'email_business_proj'        => (!empty($data['dop_email']) ? $data['dop_email'] : 0),
                'notification_business_proj' => (!empty($data['notification']) ? 1 : 0),
                'img_business_proj'          => $data['load_img'],
                'title_business_proj'        => $data['name_advert'],
                'h1_business_proj'           => $data['name_advert'],
                'desc_business_proj'         => strip_tags($data['mini_desc']),
                'text_business_proj'         => $data['full_desc'],
                'updated_at_business_proj'   => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectImg($data){

        return DB::table('fev_business_proj')
            ->where([
                ['id_business_proj', $data['id_advert']],
                ['id_user_business_proj', $data['id_user']],
            ])
            ->update([
                'img_business_proj'          => $data['load_img'],
                'updated_at_business_proj'   => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectStatus($data){

        return DB::table('fev_business_proj')
            ->where([
                ['id_business_proj', $data['id_advert']],
                ['id_user_business_proj', $data['id_user']],
            ])
            ->update([
                'status_business_proj'       => $data['status'],
                'type_business_proj'         => !isset($data['type_adverts']) ? 0 : $data['type_adverts'],
                'updated_at_business_proj'   => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectFeedBack($data){

        return DB::table('fev_business_proj')
            ->where([
                ['id_business_proj', $data['id_advert']],
            ])
            ->update([
                'feedbacks_business_proj'  => $data['feedbacks'],
                'updated_at_business_proj' => date("Y-m-d H:i:s")
            ]);

    }
    public static function updateProjectViews($data){

        return DB::table('fev_business_proj')
            ->where([
                ['id_business_proj', $data['id_advert']],
            ])
            ->update([
                'views_business_proj'      => $data['views'],
                'updated_at_business_proj' => date("Y-m-d H:i:s")
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