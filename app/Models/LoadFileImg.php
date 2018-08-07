<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

Class LoadFileImg extends model{

    public $f__file_info;

    //Пасширение файла
    public $f__ext;

    //Уникальное имя файла
    public $f__file;

    //Массив допустимых расширений, при необходимости можно добавить
    public $f__array_type = array('.jpg', '.gif', '.png', '.JPG', '.GIF', '.PNG');

    //Путь где будут временно хрониться файлы Картинок
    public $f_upload_dir = '/../../public/img/';

    public $f_return_dir = "/public/img/";

    public $f_section = false;

    public $f_code = false;

    /*
     *
     * FEV
     * Модель для обработки и работы с графическими файлами
     *
     */

    public function __construct(){

        $dir = __DIR__;
        $this->f_upload_dir = $dir.$this->f_upload_dir;

    }
    //Принимаем аргумент типа: $_FILE['имя_инпута']
    public function checkExt($file){

        $this->f__file_info = $file;

        // Берем расширение файла
        $this->f__ext = substr($this->f__file_info['name'],strpos($this->f__file_info['name'],'.'),strlen($this->f__file_info['name'])-1);

        //Проверяем соответствует ли расширение файла перечисленному в массиве $f__array_type
        return (in_array($this->f__ext, $this->f__array_type)) ? true : false;

    }
    public function setFileName(){

        //Генерируем уникальное имя для файла (рандом, пропускаем через md5 и обрезаем в 10 символов, в конеч добавляем дату заливки)
        $this->f__file = substr(md5(time().rand(100, 19900).time()), 0, 10)."_".date("Y_m_d_H_i").$this->f__ext;

    }
    public function setDirName(){

        //Получаем имя дериктории сегоднешнего числа
        $modify_dir = self::checkFileExists($this->f_upload_dir).'/';

        //Модифицируем имя директории
        $this->f_upload_dir .= $modify_dir;
        $this->f_return_dir .= $modify_dir;

    }
    public function getFileName(){

        //Возвращаем уникальное имя для файла
        return $this->f__file;

    }
    public static function checkFileExists($file_dir){

        $dir_name = date("Y_m_d");

        if(!file_exists($file_dir.$dir_name)){

            mkdir($file_dir.$dir_name);

        }

        return $dir_name;

    }
    // Принимаем аргументы: $this->f__file_info, $this->f_upload_dir, $this->f__file
    public static function uploadFile($file_info, $file_dir, $file){

        //Загружаем файл на сервер
        return copy($file_info['tmp_name'], $file_dir.$file);

    }

    public static function addImg($path, $uid){

        return DB::table('fev_img_reports')->insertGetId([
            'id_user_img' => $uid,
            'path_img'    => $path,
            'status_img'  => 0,
            'created_at'  => date("Y-m-d H:i:s"),
            'updated_at'  => date("Y-m-d H:i:s"),
        ]);

    }

    public static function getImgOnId($idi, $idu){

        return Db::table('fev_img_reports')
            ->where([
                ['id_img', $idi],
                ['id_user_img', $idu],
            ])
            ->limit(1)
            ->get();

    }
    public static function getImgOnPath($path, $idu){

        return Db::table('fev_img_reports')
            ->where([
                ['path_img', $path],
                ['id_user_img', $idu],
            ])
            ->limit(1)
            ->get();

    }
    public static function updateImgOnId($path, $idu){

        return DB::table('fev_img_reports')
            ->where([
                ['path_img', $path],
                ['id_user_img', $idu],
            ])
            ->update([
                'status_img' => 1,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

    }
    public static function deleteImgOnId($idi, $idu){
        return Db::table('fev_img_reports')
            ->where([
                ['id_img', $idi],
                ['id_user_img', $idu],
            ])
            ->delete();

    }
    public static function getDirLink($path){

        return __DIR__.'/../..'.$path;

    }
    public static function deleteImg($path){

        $link = self::getDirLink($path);
        return unlink($link);

    }
    public static function getImgString($imgs, $user, $idg, $api){

        $file_name = '';
        $dir_file = __DIR__.'/../..';
        $string_img = '';
        $array_img = explode(',', $imgs);

        if(is_array($array_img) AND $idg == '4'){

            for($i=0; $i <= count($array_img); $i++){

                if(isset($array_img[$i]) AND !empty($array_img[$i])){

                    $file_name = str_replace('[', '', str_replace(']', '', $array_img[$i]));

                    if(file_exists($dir_file.$file_name) === true){

                        self::updateImgOnId($file_name, $user->getUserId());
                        $string_img .= '"' . $file_name . '",';

                    }else{

                        print $file_name;

                        $api->setData('error_status', 'true');
                        $api->upSetData('error_message', 'Загружаемого файла ['. $file_name .'] не существует!');

                        return false;
                        break;

                    }

                }

            }

            return '[' . substr($string_img, 0, -1) . ']';

        }else{

            if(file_exists($dir_file.$imgs)){

                self::updateImgOnId($imgs, $user->getUserId());
                return $imgs;

            }else{

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Загружаемого файла - ['. $imgs .'] не существует!');

                return false;

            }

        }

    }

}