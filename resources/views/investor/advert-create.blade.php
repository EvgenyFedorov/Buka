@extends('investor.app')

@section('content')
<!--script src="{{ url('public/js/ckeditor/ckeditor.js') }}" rel="script" type="text/javascript"></script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="{{ url('public/js/adverts-investor.js') }}" rel="script" type="text/javascript"></script>
<style>
    #preloader {visibility: hidden;}
</style>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Раздел:</div>
    <div class="col-md-8 setting-input">
        <select class="form-control" id="activity">
            @foreach($activities as $activity)
                <option value="{{$activity->id_activitie}}">{{$activity->name_activitie}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row setting-row" id="block-sub-activity" style="display: none;">
    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Категория:</div>
    <div class="col-md-8 setting-input">
        <select class="form-control" id="sub-activity"></select>
    </div>
    <div class="col-md-12" id="block-all-sub-activities" style="display: none;">
        <div id="visual-sub-activities-selected" style="margin-top: 20px; height: 150px; overflow: auto; border: 1px solid #f1f1f1; padding: 10px;">

        </div>
    </div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Доп. Email адрес:</div>
    <div class="col-md-8 setting-input">
        <input type="text" class="form-control" id="dop-email">
    </div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Доп. Телефон:</div>
    <div class="col-md-8 setting-input">
        <input type="text" class="form-control" id="dop-phone">
    </div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Сумма инвестиций:</div>
    <div class="col-md-8 setting-input">
        <input type="text" class="form-control" id="sum-invest">
    </div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input">Получать уведомления:</div>
    <div class="col-md-8 setting-input">
        <div class="material-switch pull-left" style="margin-top: 7px;">
            <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
            <label for="someSwitchOptionSuccess" class="label-success autopilot_select"></label>
        </div>
    </div>
</div>
<div class="row setting-row" style="margin-top: 20px; border-top: 1px solid #f1f1f1; padding-top: 20px;">
    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Загрузите 1 картинку</div>
    <div class="col-md-8 setting-input">
        <progress style="display: none;"></progress>
        <div id="btn-uploaded-photo" style="margin-top: 8px; display: inline-block; font-size: 17px; cursor: pointer; height: auto; background: #f0ad4e; color: #fff; padding: 7px;">
            Загрузить фото
        </div>&nbsp;
        <span style="font-size: 13px;">Пропорции 350 X 154</span>
        <div id="block-upload-result" style="border: 1px solid #f1f1f1; margin-top: 20px; display: none;"></div>
        <form style="display: none;" action="" enctype="multipart/form-data" method="POST">
            <input id="file" type="file" multiple="multiple" name="file[]" />
            <div id="preloader"><img alt="loader" src="preloader.gif" /></div>
            <div id="info"></div>
        </form>
    </div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Название объявления:</div>
    <div class="col-md-8 setting-input">
        <input type="text" class="form-control" id="name-advert">
    </div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Краткое описание:</div>
    <div class="col-md-8 setting-input">
        <textarea name="mini-description" class="form-control"></textarea>
    </div>
</div>
<div class="row setting-row">
    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Полное описание:</div>
    <div class="col-md-8 setting-input">
        <textarea name="full-description" class="form-control"></textarea>
    </div>
</div>
<div class="row setting-row" style="margin-top: 20px; padding-top: 20px;">
    <div class="col-md-12" style="text-align: right;">
        <a class="btn btn-success" id="add-advert-investor">Создать объявление</a>
    </div>
</div>
<div class="row setting-row" style="margin-top: 20px; border-top: 1px solid #f1f1f1; padding-top: 20px; display: none;">
    <div class="col-md-4 setting-label-input" style="margin-top: 7px;">Баланс:</div>
    <div class="col-md-3 setting-input" style="margin-top: 7px;">
        &nbsp;Руб.
    </div>
    <div class="col-md-5" style="text-align: right;">
        <div class="btn btn-success">Пополнить</div>
    </div>
</div>
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<input type="hidden" id="select-activity" value="">
<input type="hidden" id="select-sub-activities" value="">
<input type="hidden" id="select-notification" value="">
<input type="hidden" id="file-upload-advert" value="">
<script src="{{ url('public/js/load-images-investor.js') }}" rel="script" type="text/javascript"></script>
@endsection
