@extends('investor.app')

@section('content')
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="{{ url('public/js/payment-advert-investor.js') }}" rel="script" type="text/javascript"></script>
    <div class="row setting-row" style="padding: 0 10px 0 10px;">
        @if(isset($projects->id_investor_proj))
            <?php
            $bg = '#FFFFCC;';
            $border = 'red;';
            ?>
            <div class="col-md-12" style="margin-bottom: -30px; text-align: center;">
                <div id="block-pre-advert" class="row" style="border: 1px solid <?=$border; ?> margin-bottom: 20px; background: <?=$bg; ?>">
                    <div class="col-md-12">
                        <div style="margin: 10px 0 10px 0; display: inline-block; font-size: 20px; padding: 7px; color: #666666;">
                            {{$projects->title_investor_proj}}
                        </div>
                    </div>
                    <div class="col-md-6" style="border-right: 1px solid <?=$border; ?>">
                        @if(isset($projects->img_investor_proj))
                            <img id="img_default_{{$projects->id_investor_proj}}" src="{{$projects->img_investor_proj}}" style="width: 100%; margin-bottom: 15px;">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6" style="text-align: right;">Просмотров:</div>
                            <div class="col-md-6" style="text-align: left;">{{$projects->views_investor_proj}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="text-align: right;">Откликов:</div>
                            <div class="col-md-6" style="text-align: left;">{{$projects->feedbacks_investor_proj}}</div>
                        </div>
                        <div class="row" style="margin: 10px 0 10px 0;">
                            <div class="col-md-1"></div>
                            <div class="col-md-10" style="border-top: 1px solid <?=$border; ?>"></div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row" style="margin: 10px 0 10px 0;">
                            <div class="col-md-12" style="padding-top: 15px;">
                                <span style="font-weight: bold; font-size: 25px;" id="sum-pay-advert">1499</span>
                                <i class="glyphicon glyphicon-rub" style="font-size: 19px; color: green;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12" style="font-size: 20px; margin: 20px 0 20px 0;">Выберите тип объявления</div>
                    <div class="col-md-4">
                        <div id="block-type-advert-3" class="block-type-advert" style="border: 1px solid #cecece; padding: 10px 0 10px 0;">
                            <span style="text-decoration: underline; display: block;">Обычное</span>
                            <div style="margin-top: 10px;">
                                <span style="font-weight: bold; font-size: 25px;">500</span>
                                <i class="glyphicon glyphicon-rub" style="font-size: 19px; color: green;"></i>
                            </div>
                            <div name="500" class="btn btn-default type-advert-selet" id="3" style="margin-top: 10px;">Выбрать</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="block-type-advert-2" class="block-type-advert" style="border: 1px solid green; background: #fffff1; padding: 10px 0 10px 0;">
                            <span style="text-decoration: underline;">Выделенное</span>
                            <div style="margin-top: 10px;">
                                <span style="font-weight: bold; font-size: 25px;">900</span>
                                <i class="glyphicon glyphicon-rub" style="font-size: 19px; color: green;"></i>
                            </div>
                            <div style="margin-top: 10px; font-size: 12px; text-align: left;">
                                <ul style="padding: 0 0 0 18px;">
                                    <li style="padding: 0;">В 3 раза эфективней</li>
                                    <li style="padding: 0;">В спец. рамке</li>
                                </ul>
                            </div>
                            <div name="900" class="btn btn-default type-advert-selet" id="2" style="margin-top: 10px;">Выбрать</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="block-type-advert-1" class="block-type-advert" style="border: 1px solid red; background: #FFFFCC; padding: 10px 0 10px 0;">
                            <span style="text-decoration: underline;">Спец размещение</span>
                            <div style="margin-top: 10px;">
                                <span style="font-weight: bold; font-size: 25px;">1499</span>
                                <i class="glyphicon glyphicon-rub" style="font-size: 19px; color: green;"></i>
                            </div>
                            <div style="margin-top: 10px; font-size: 12px; text-align: left;">
                                <ul style="padding: 0 0 0 18px;">
                                    <li style="padding: 0;">В 10 раз эфективней</li>
                                    <li style="padding: 0;">Спец. оформлено</li>
                                    <li style="padding: 0;">Всегда сверху в списке</li>
                                    <li style="padding: 0;">На всех страницах</li>
                                </ul>
                            </div>
                            <div name="1499" class="btn btn-default type-advert-selet" id="1" style="margin-top: 10px;">Выбрать</div>
                        </div>
                    </div>
                </div>
                <div class="row block-type-payment" style="border: 1px solid #cecece; margin-bottom: 20px; display: none;">
                    <div class="col-md-12" style="font-size: 20px; margin: 20px 0 20px 0;">Оплата</div>
                    <div class="col-md-9">
                        <div style="padding: 10px;">
                            <select class="form-control" id="select-type-payment">
                                <option value="1">Оплатить отдельно</option>
                                <option value="2">Списать со счета</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin: 10px 0 20px 0;">
                        <div class="btn btn-success btn-payment-go">Оплатить</div>
                    </div>
                </div>
            </div>
        @else
            <div style="text-align: center;">
                Объявления отсутствуют!<br>
                <a href="/profile/advert-create" class="btn btn-primary" style="margin-top: 20px;">Добавить объявление</a>
            </div>
        @endif
    </div>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="id_advert" value="{{$projects->id_investor_proj}}">
    <input type="hidden" id="type_adverts" value="1">
    <script src="{{ url('public/js/load-images-investor.js') }}" rel="script" type="text/javascript"></script>
@endsection
