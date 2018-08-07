<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api\LoadCars;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\ErrorsController;


class ApiController extends Controller
{

    protected $url;
    private $api_data = array('error_status' => 'false');
    private $json = null;

    public $count_files = 0;

    public function registration($input){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($input['tarif_investor']) OR empty($input['tarif_investor'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: tarif_investor');

        }
        if(!isset($input['phone_investor']) OR empty($input['phone_investor'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: phone_investor');

        }
        if(!isset($input['mail_investor']) OR empty($input['mail_investor'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: mail_investor');

        }
        if(!isset($input['name_investor']) OR empty($input['name_investor'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: name_investor');

        }
        if(!isset($input['fname_investor']) OR empty($input['fname_investor'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: fname_investor');

        }
        if(!isset($input['passw_investor']) OR empty($input['passw_investor'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: passw_investor');

        }
        if(!isset($input['passw2_investor']) OR empty($input['passw2_investor'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: passw2_investor');

        }


    }
    public function createAdvert($input){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($input['activity']) OR empty($input['activity'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: activity');

        }
        if(!isset($input['sub_activity']) OR empty($input['sub_activity'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: sub_activity');

        }
        if(!isset($input['sum_invest']) OR empty($input['sum_invest'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: sum_invest');

        }
        if(!isset($input['name_advert']) OR empty($input['name_advert'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: name_advert');

        }
        if(!isset($input['mini_desc']) OR empty($input['mini_desc'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: mini_desc');

        }
        if(!isset($input['full_desc']) OR empty($input['full_desc'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: full_desc');

        }
        if(!isset($input['load_img']) OR empty($input['load_img'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: load_img');

        }

    }
    public function paymentAdvert($input){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($input['id_advert']) OR empty($input['id_advert'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: id_advert');

        }
        if(!isset($input['type_adverts']) OR empty($input['type_adverts'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: type_adverts');

        }
        if(!isset($input['type_payment']) OR empty($input['type_payment'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: type_payment');

        }

    }
    public function updateAdvert($input, $idg){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($input['id_advert']) OR empty($input['id_advert'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: id_advert');

        }
        if(!isset($input['sum_invest']) OR empty($input['sum_invest'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: sum_invest');

        }
        if(!isset($input['name_advert']) OR empty($input['name_advert'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: name_advert');

        }
        if(!isset($input['mini_desc']) OR empty($input['mini_desc'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: mini_desc');

        }
        if(!isset($input['full_desc']) OR empty($input['full_desc'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: full_desc');

        }
        if(!isset($input['load_img']) OR empty($input['load_img'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: load_img');

        }
        if($idg == '4'){

            if(!isset($input['sum_turn']) OR empty($input['sum_turn'])){

                $this->setData('error_status', 'true');
                $this->upSetData('error_message', 'Отсутствует обязательный параметр: sum_turn');

            }
            if(!isset($input['sum_profit']) OR empty($input['sum_profit'])){

                $this->setData('error_status', 'true');
                $this->upSetData('error_message', 'Отсутствует обязательный параметр: sum_profit');

            }
            if(!isset($input['sum_expe']) OR empty($input['sum_expe'])){

                $this->setData('error_status', 'true');
                $this->upSetData('error_message', 'Отсутствует обязательный параметр: sum_expe');

            }
            if(!isset($input['sum_proportion']) OR empty($input['sum_proportion'])){

                $this->setData('error_status', 'true');
                $this->upSetData('error_message', 'Отсутствует обязательный параметр: sum_proportion');

            }

        }

    }
    public function countUploadFilesInvestorProject($files, $count_limit){

        $this->count_files = count($files);

        if($this->count_files > $count_limit){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Превышен допустимый лимит загружаемых файлов: 1');

        }

    }
    public function deleteImage($input){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($input['id_img']) OR empty($input['id_img'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: id_img');

        }
        if(!isset($input['del_img']) OR empty($input['del_img'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: del_img');

        }
        if(!isset($input['load_img']) OR empty($input['load_img'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: load_img');

        }

    }
    public function sendMessage($input){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($input['id_dialog']) OR empty($input['id_dialog'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: id_dialog');

        }
        if(!isset($input['message']) OR empty($input['message'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: message');

        }

    }
    public function sendDialog($input){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($input['id_advert']) OR empty($input['id_advert'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: id_advert');

        }
        if(!isset($input['theme']) OR empty($input['theme'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: theme');

        }
        if(!isset($input['message']) OR empty($input['message'])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: message');

        }

    }
    public function uploadFile($input, $file){

        if(!isset($input['_token']) OR $input['_token'] != csrf_token()){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: _token');

        }
        if(!isset($file) OR empty($file)){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: data');

        }

    }
    public function chechInput($input, $key){

        if(!isset($input[$key]) OR empty($input[$key])){

            $this->setData('error_status', 'true');
            $this->upSetData('error_message', 'Отсутствует обязательный параметр: '.$key);

            return false;

        }else{

            return true;

        }

    }
    public static function getSubActivities($obj){

        $list = '<option>Категории раздела</option>';

        foreach ($obj as $row){

            $list .= '<option value="'.$row->id_sub_activitie.'" id="sa_'.$row->id_sub_activitie.'">'.$row->name_sub_activitie.'</option>';

        }

        return $list;

    }
    public function setData($key, $string){

        $this->api_data[$key] = $string;

    }
    public function upSetData($key, $string){

        $this->api_data[$key][] = $string;

    }
    public function jsonEncode(){

        $this->json = json_encode($this->api_data);

    }
    public function getData($key){

        return $this->api_data[$key];

    }
    public function getJson(){

        $this->jsonEncode();
        return $this->json;

    }

}
