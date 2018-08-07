<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\MyExcel;
use App\Models\Cars;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

Class UserController extends Controller
{
    private $user;
    private $request;
    private $url;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = $request->user();
    }

    public function index(){

        $data_cars = Cars::getCarsDillerList($this->user['id']);

        return view('car.carlist', [
            'data_cars' => $data_cars
        ]);

    }
    public function editCar($id_car){

        $data_car = Cars::getCarsDillerOne($this->user['id'], $id_car);

        return view('car.editcar', [
            'data_car' => $data_car['0']
        ]);

    }
    public function saveCar(){

        $input = $this->request->input();

        Cars::saveCarDiller($this->user['id'], $input);

        return redirect('/diller');

    }
    public function excelAction(){

        return view('loadfile.loadfile');

    }
    public function loadExcel(){

        $file = $this->user['id'] . substr(sha1(rand(1111, 999999)), 0, rand(5, 10));

        Input::file('file_excel')->move(__DIR__.'/../../../excel/', $file . '.xls');

        self::excelImporting(__DIR__.'/../../../excel/'.$file.'.xls');

        unlink(__DIR__.'/../../../excel/'.$file.'.xls');

        //return view('goodload.loadfile');

        return redirect('/diller');

    }
    public function excelImporting($url){

        $excel = new MyExcel;

        //Тестовая загрузка Excel
        //$url = __DIR__.'/../../../excel/18b2e08e78.xls';

        // Проверяем существует ли файл
        if(file_exists($url)){

            //Загружаем Excel и передаем в качестве аргумена url файла
            $excel->loadExcel($url);

            //Увеличиваем время работы php До 500 сек.
            set_time_limit(500);

            //Возвращаем массив строк из загруженного Excel(я)
            $array_excel = $excel->getExcel();

            //Открываем транзакцию
            DB::beginTransaction();

            for($i=0; $i <= count($array_excel); $i++){

                if(!empty($array_excel[$i])){

                    $columns = "cardb_id, cardb_model_id, cardb_car_id, internal_code, name, model_name";

                    $cars_array = DB::select("SELECT ".$columns." FROM car_model_exterior_color WHERE cardb_id = '{$array_excel[$i]['2']}' LIMIT 1");

                    //print_r($cars_array['0']);

                    //Формируем ссылку на картинку
                    $this->url = 'http://prev.images.lexus-europe.com/url/renderSpecificVehicle.ashx?';
                    $this->url .= 'brand=Lexus&country=RU&view=exterior&angle=02&format=png&mode=DAY&image-quality=75&scale-mode=1&width=770&height=340';
                    $this->url .= '&model='.$array_excel[$i]['3'];
                    $this->url .= '&car='.$array_excel[$i]['4'];
                    $this->url .= '&exterior='.$cars_array['0']->cardb_id;

                    //Дергаем картинку
                    $img = Image::cache(function($image){
                        $image->make($this->url);
                    }, 10, true);

                    // Удаляем пробелы из названия модели
                    $array_excel[$i]['7'] = preg_replace('/[^a-zA-Z0-9]+/', '', $array_excel[$i]['7']);

                    // Если изображения не существует с таким именем
                    if(!file_exists(__DIR__.'/../../../public/img/'.$array_excel[$i]['7'].$cars_array['0']->internal_code.'.png')){

                        //Сохраняем его
                        $img->save(__DIR__.'/../../../public/img/'.$array_excel[$i]['7'].$cars_array['0']->internal_code.'.png');

                    }

                    $car = new Cars;

                    // Добавляем в транзакцию инсерт строки из Excel(я), аргументом передаем массив строки
                    $car->insertCar($array_excel[$i], $cars_array['0'], $this->user['id']);
                    $car->save();

                }

            }

            // Коммитим транзакцию
            DB::commit();

        }else{

            print 'Файла не существует!';

        }

    }

}
