@extends('layouts.app')

@section('content')
    <table class="table table-hover table-striped" style="width: 95%; margin: auto">
        <thead>
            <tr>
                <td>Модель</td>
                <td>Комплектация</td>
                <td>Цвет экстерьера</td>
                <td>Цвет интерьера</td>
                <td>Цена</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_cars as $car_rows)
                <tr class="car_diller_action" id="id_{{$car_rows->id}}_id">
                    <td>{{$car_rows->model_name}}</td>
                    <td>{{$car_rows->equipment_name}}</td>
                    <td>{{$car_rows->exterior_color}}</td>
                    <td>{{$car_rows->interior_color}}</td>
                    <td>{{$car_rows->price}}</td>
                    <td>
                        <a href="/diller/edit/{{$car_rows->id}}">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" id="delete_cars" value=""/>
@endsection
