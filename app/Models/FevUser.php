<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FevCart;
use App\User;

Class FevUser extends model{

    public $array_data;
    public $cart_orders;
    public $products_cart_all;

    public static function createUser($array){

        return DB::table('users')->insertGetId([
            'email' => $array['email'],
            'password' => bcrypt($array['password']),
            'no_hash_pass' => $array['password'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'last_ip' => $_SERVER['REMOTE_ADDR'],
            'id_group' => $array['id_group'],
            'user_ranks' => $array['user_ranks'],
            'count_adverts' => 0,
            'confirm_email_link' => $array['confirm_link'],
            'confirm_email_status' => 0,
            'recovery_pass' => 0,
            'avatar' => 0,
            'status_online' => 0,
            'count_referals' => 0,
            'id_invite_user' => 0,
            'invite_code' => $array['invite_code'],
            'remember_token' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

    }

    public function setFullCartProductsInfoRobokassa($id, $status){

        if($status !== false){

            //print "1<br>".$id."|".$status;
            $this->cart_orders = FevCart::loadCartAdmin([
                'id_cart'     => $id,
                'status_cart' => $status
            ]);
        }else{
            //print "2<br>";
            $this->cart_orders = FevCart::loadCartAdmin([
                'id_cart'     => $id
            ]);
        }

        if(isset($this->cart_orders[0])){

            //print "<br>3<br>";

            $cart_sum   = 0;
            $cart_count = 0;

            $products_cart = FevCart::loadFullProductCart(array(
                'fev_cart_product.id_cart' => $id
            ), 'asc');

            foreach ($products_cart as $products_cart_row){

                $products_cart_row->prod_all_sum = ($products_cart_row->cart_prod_sum * $products_cart_row->prod_counts);
                $this->products_cart_all[] = $products_cart_row;

                $cart_sum   = ($cart_sum + ($products_cart_row->cart_prod_sum * $products_cart_row->prod_counts));
                $cart_count = ($products_cart_row->prod_counts + $cart_count);

            }

            $this->cart_orders[0]->cart_sum   = $cart_sum;
            $this->cart_orders[0]->cart_count = $cart_count;

        }

    }

    public static function getGenerationCode($start, $stop){

        $key = array(1=>'a', 2=>'b', 3=>'c', 4=>'d', 5=>'e', 6=>'f', 7=>'g', 8=>'h', 9=>'i', 10=>'j', 11=>'k', 12=>'l', 13=>'m', 14=>'n', 15=>'o',
            16=>'p', 17=>'q', 18=>'r', 19=>'s', 20=>'t', 21=>'u', 22=>'v', 23=>'w', 24=>'x', 25=>'y', 26=>'z', 27=>'1', 28=>'2', 29=>'3', 30=>'4',
            31=>'5', 32=>'6', 33=>'7', 34=>'8', 35=>'9', 36=>'0');

        $up_down = array(1=>'strtolower',2=>'strtoupper');

        $str_width = rand($start, $stop);

        $pass_key = '';

        for($i=1; $i <= $str_width; $i++){

            $func = $up_down[rand(1,2)];

            $pass_key .= $func($key[rand(1, count($key))]);

        }

        return $pass_key;

    }
    public static function getUserStatDay(){

        return DB::table('users')
            ->select('id_user_info', 'user_info_f_name', 'user_info_name', 'user_info_stat_day')
            ->leftJoin('fev_user_info', 'users.id', '=', 'fev_user_info.id_user_info')
            ->orderBy('user_info_stat_day', 'desc')
            ->limit(10)->get();

    }
    public static function getUserStatWeek(){

        return DB::table('users')
            ->select('id_user_info', 'user_info_f_name', 'user_info_name', 'user_info_stat_wek')
            ->leftJoin('fev_user_info', 'users.id', '=', 'fev_user_info.id_user_info')
            ->orderBy('user_info_stat_wek', 'desc')
            ->limit(10)->get();

    }
    public static function getUserStatMonth(){

        return DB::table('users')
            ->select('id_user_info', 'user_info_f_name', 'user_info_name', 'user_info_stat_mont')
            ->leftJoin('fev_user_info', 'users.id', '=', 'fev_user_info.id_user_info')
            ->orderBy('user_info_stat_mont', 'desc')
            ->limit(10)->get();

    }
    public static function getTransfers($data){

        return DB::table('fev_partner_transfer_money')
            ->where($data)
            ->orderBy('created_at', 'desc')
            ->limit(200)->get();

    }
    public static function getUser($data){

        return DB::table('users')
            ->where($data)
            ->limit(1)->get();

    }
    public static function userEmailExist($data){

        return DB::table('users')
            ->select('email')
            ->where($data)
            ->limit(1)->get();

    }
    public static function getMoneyInfoOnId($id){

        return DB::table('fev_user_money_info')
            ->where([
                ['id_money_user', $id]
            ])
            ->limit(1)->get();

    }
    public static function getUserNotConfirmEmailOnCode($code){

        return DB::table('users')
            ->select('id','email','no_hash_pass')
            ->where([
                ['confirm_email_link', $code],
                ['confirm_email_status', 0]
            ])->limit(1)->get();

    }
    public static function updateConfirmEmailUserOnId($id){

        return DB::table('users')
            ->where([
                ['id', $id]
            ])
            ->update([
                'confirm_email_link' => 0,
                'confirm_email_status'   => 1
            ]);

    }
    public static function addUserInfo($data){

        return DB::table('fev_user_info')->insertGetId([
            'id_user_info'         => $data['id'],
            'user_info_name'       => $data['name'],
            'user_info_f_name'     => $data['fname'],
            'user_info_phone'      => $data['user_phone'],
            'user_info_phone_show' => 0,
            'user_info_email_show' => 0,
            'user_info_country'    => !empty($data['user_country']) ? $data['user_country'] : 0,
            'user_info_region'     => !empty($data['user_region']) ? $data['user_region'] : 0,
            'user_info_city'       => !empty($data['user_city']) ? $data['user_city'] : 0,
            'user_info_money_summ' => 0,
            'created_at'           => date("Y-m-d H:i:s"),
            'updated_at'           => date("Y-m-d H:i:s")
        ]);

    }
    public static function updateUserInfoTbl($id, $data){

        return DB::table('fev_user_info')
            ->where([
                ['id_user_info', $id]
            ])
            ->update($data);

    }
    public static function getUserInfoOnId($id){

        return DB::table('users')
            ->select('id', 'email', 'id_group', 'user_ranks', 'count_adverts', 'user_info_name', 'user_info_f_name', 'user_info_phone', 'user_info_country', 'user_info_region', 'user_info_city', 'user_info_money_summ')
            ->leftJoin('fev_user_info', 'users.id', '=', 'fev_user_info.id_user_info')
            ->where([
                ['id_user_info', $id]
            ])->limit(1)->get();

    }
    public static function getInviteUsers($data){

        return DB::table('users')
            ->where($data)
            ->orderBy('id', 'asc')->get();

    }
    public static function getReferalUsers($data){

        return DB::table('fev_user_info')
            ->leftJoin('fev_partner_transfer_money', 'fev_user_info.id_user_info', '=', 'fev_partner_transfer_money.id_user_referal')
            ->where($data)
            ->orderBy('id_transfer_money', 'asc')->get();


    }
    public static function addTransferReferalUser($data){

        return DB::table('fev_partner_transfer_money')->insertGetId($data);

    }
    public static function addMoneyInfo($data){

        return DB::table('fev_user_money_info')->insertGetId($data);

    }
    public static function updateMoneyInfo($id, $data){

        return DB::table('fev_user_money_info')
            ->where([
                ['id_money_user', $id]
            ])
            ->update($data);

    }
}