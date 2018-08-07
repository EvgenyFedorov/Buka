<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

Class MyExcel extends model{

    private $array;

    public function loadExcel($url_excel){

        // Передаем аргументом ссылку на загруженный файл Excel
        Excel::load($url_excel, function($reader) {

            // Получаем объект
            $reader->each(function ($sheet) {

                // Разбиваем объект на массивы
                foreach ($sheet->toArray() as $rows) {

                    // Сбрасываем индексы массивов, у нас получается 0,1,2,3... и т.д.
                    $this->array[] = array_values($rows);

                }

            });

        });

    }
    public function getExcel(){

        // Возвращаем сформированный массив
        return $this->array;

    }

}