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
          <form action="{{ url('diller/save') }}" method="POST" class="form-vertical">
            <tr>
              <td><input type="text" name="model_name" value="{{$data_car->model_name}}"/></td>
              <td><input type="text" name="equipment_name" value="{{$data_car->equipment_name}}"/></td>
              <td><input type="text" name="exterior_color" value="{{$data_car->exterior_color}}"/></td>
              <td><input type="text" name="interior_color" value="{{$data_car->interior_color}}"/></td>
              <td><input type="text" name="price" value="{{$data_car->price}}"/></td>
              <input type="hidden" name="id_car" value="{{$data_car->id}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </tr>
            <tr>
              <td colspan="5"><input type="submit" value="Сохранить"></td>
            </tr>
          </form>
        </tbody>
    </table>
@endsection
