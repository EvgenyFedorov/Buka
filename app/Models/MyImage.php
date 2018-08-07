<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Customers\Customer;
use Cache;
use Intervention\Image\Facades\Image;

Class MyImage extends model{

    private $url;

    public $model_id;
    public $car_id;
    public $code_model;
    public $model_name;
    public $model_desc;

    public function getImage($array_excel){

        set_time_limit(500);

        for($i=0; $i <= count($array_excel); $i++){

            if(!empty($array_excel[$i])){

                $this->getLinkImg($array_excel[$i]);

            }

        }

    }
    public function getLinkImg($array_excel){

        $this->url = 'http://prev.images.lexus-europe.com/url/renderSpecificVehicle.ashx?brand=Lexus&country=RU&model='.$array_excel['3'].'&car='.$array_excel['4'].'&view=exterior&angle=02&format=png&mode=DAY&image-quality=75&scale-mode=1&width=770&height=340';
        //$img = Image::make($this->url);

        $img = Image::cache(function($image){
            $image->make($this->url);
        }, 10, true);

        if(!file_exists(__DIR__.'/../../public/img/'.$array_excel['7'].'.png'))
        $img->save(__DIR__.'/../../public/img/'.$array_excel['7'].'.png');

        if($this->insertCar($array_excel))
            print '<div style="border: 1px solid green;">'.$array_excel['3'].' | '.$array_excel['4'].'</div>';
        else
            print '<div style="border: 1px solid #f00;">'.$array_excel['3'].' | '.$array_excel['4'].'</div>';

    }
    public function insertCar($array){

        $this->id = NULL;
        $this->car_id = $array['4'];
        $this->model_id = $array['3'];
        $this->model_name = $array['7'];
        $this->accessories_name = 1;
        $this->existence = 1;
        $this->price = 1;
        $this->price_color = 1;
        $this->status_action = 1;
        $this->description_action = $array['6'];

        $ins = $this->save();

        /*$ins = DB::table('cars')->insert([
            ['id' => 1],
            ['car_id' => $array['4']],
            ['model_id' => $array['3']],
            ['model_name' => $array['7']],
            ['accessories_name' => 0],
            ['existence' => 1],
            ['price' => 1],
            ['price_color' => 1],
            ['status_action' => 1],
            ['description_action' => $array['6']],
        ]);*/

        return ($ins) ? true: false;

    }

}