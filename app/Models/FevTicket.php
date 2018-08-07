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


class FevTicket{

    public static function loadDialogs($where, $orWhere, $order, $limit){

        return Db::table('fev_tickets')
            ->where($where)
            ->orWhere($orWhere)
            ->orderBy($order, 'desc')
            ->limit($limit)
            ->get();

    }
    public static function loadDialog($where, $orWhere, $order){

        return Db::table('fev_tickets')
            ->select('fev_tickets.id_ticket', 'fev_tickets.theme_ticket', 'fev_tickets.updated_ticket_at', 'fev_ticket_messages.text_message', 'fev_ticket_messages.updated_message_at', 'fev_user_info.user_info_name', 'fev_user_info.user_info_f_name', 'fev_user_info.id_user_info')
            ->leftJoin('fev_ticket_messages', 'fev_tickets.id_ticket', '=', 'fev_ticket_messages.id_ticket_message')
            ->leftJoin('fev_user_info', 'fev_ticket_messages.id_user_message', '=', 'fev_user_info.id_user_info')
            ->where($where)
            ->orWhere($orWhere)
            ->orderBy($order, 'asc')
            ->get();

    }
    public static function addDialog($data){

        return DB::table('fev_tickets')->insertGetId([
            'id_from_user'      => $data['id_from_user'],
            'id_to_user'        => $data['id_to_user'],
            'id_proj_ticket'    => $data['id_advert'],
            'theme_ticket'      => $data['theme'],
            'status_ticket'     => 0,
            'created_ticket_at' => date("Y-m-d H:i:s"),
            'updated_ticket_at' => date("Y-m-d H:i:s")
        ]);

    }
    public static function addMessage($data){

        return DB::table('fev_ticket_messages')->insertGetId([
            'id_user_message'    => $data['id_from_user'],
            'id_ticket_message'  => $data['id_ticket'],
            'text_message'       => $data['message'],
            'status_message'     => 0,
            'created_message_at' => date("Y-m-d H:i:s"),
            'updated_message_at' => date("Y-m-d H:i:s")
        ]);

    }
    public static function loadCountDialog($where, $orWhere){

        return Db::table('fev_tickets')
            ->where($where)
            ->orWhere($orWhere)
            ->count();

    }

}