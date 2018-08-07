@extends('businessman.app')

@section('content')
<script src="{{ url('public/js/businessman.js') }}" rel="script" type="text/javascript"></script>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Имя:</div>
    <div class="col-md-6 setting-input">
        <input type="text" class="form-control" value="{{$name}}">
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Фамилия:</div>
    <div class="col-md-6 setting-input">
        <input type="text" class="form-control" value="{{$fname}}">
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Email адрес:</div>
    <div class="col-md-6 setting-input">
        <input type="text" disabled class="form-control" value="{{$email}}">
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Телефон:</div>
    <div class="col-md-6 setting-input">
        <input type="text" disabled class="form-control" value="{{$phone}}">
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Получать уведомления:</div>
    <div class="col-md-6 setting-input">
        <div class="material-switch pull-left" style="margin-top: 7px;">
            <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
            <label for="someSwitchOptionSuccess" class="label-success autopilot_select"></label>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row setting-row" style="margin-top: 20px; border-top: 1px solid #f1f1f1; padding-top: 20px;">
    <div class="col-md-4 setting-label-input" style="margin-top: 7px;">Баланс:</div>
    <div class="col-md-3 setting-input" style="margin-top: 7px;">
        {{$money}}&nbsp;Руб.
    </div>
    <div class="col-md-3" style="text-align: right;">
        <div class="btn btn-success">Пополнить</div>
    </div>
    <div class="col-md-2"></div>
</div>
@endsection
