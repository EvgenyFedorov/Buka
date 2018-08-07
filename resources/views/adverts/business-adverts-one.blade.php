@extends('adverts.app-business-adverts-one')

@section('content')
    <link href="{{ url('public/css/jquery.fancybox.min.css') }}" rel="stylesheet prefetch">
    <script src="{{ url('public/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ url('public/js/adverts-businessman.js') }}" rel="script" type="text/javascript"></script>
    <div class="row setting-row" style="padding: 0; border: 1px solid #f1f1f1;">
        <?php
        $sum = '';
        $count_sumbols = 3;
        $strlen = strlen($project->sum_business_proj);
        $delimeter = floor(($strlen / $count_sumbols));
        for($i=1; $i <= $delimeter; $i++){

            $count_sumbols_left = ($strlen - ($count_sumbols * $i));

            if($i == 1){
                $sum = '&nbsp;'.substr($project->sum_business_proj, $count_sumbols_left);
            }else{
                $count_sumbols_right = (($count_sumbols * $i) - 3);
                $sum = '&nbsp;'.substr($project->sum_business_proj, $count_sumbols_left, -$count_sumbols_right).$sum;
            }

        }

        $sum = substr($project->sum_business_proj, 0, -($count_sumbols * $delimeter)).$sum;
        ?>
        <div class="col-md-12" style="padding-left: 15px; padding-right: 15px; margin-bottom: 20px;">
            <div>
                <h1 style="font-size: 28px; display: inline-block;">{{$project->h1_business_proj}}</h1>
                <div style="display: inline-block; margin-top: 30px; color: #cecece; font-size: 17px; float: right;">
                    <i class="glyphicon glyphicon-eye-open"></i>&nbsp;
                    <span>{{$project->views_business_proj}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="padding-left: 15px; padding-right: 15px; margin-bottom: 20px;">
            <div class="row">
                <div style="border-top: 1px solid #f1f1f1; margin: 0 20px 20px 20px;"></div>
            </div>
            <div class="row">
                <div class="col-md-4" style="border-right: 1px solid #f1f1f1;">
                    <div style="font-size: 18px; text-align: center;">Сфера деятельности:</div>
                    <div style="padding: 10px;">
                        <div style="display: inline-block;">
                            <i class="glyphicon glyphicon-screenshot" style="font-size: 25px; vertical-align: middle;"></i>&nbsp;
                        </div>
                        <div style="display: inline-block; vertical-align: middle; min-height: 20px; max-height: 60px; width: 200px;">
                            <h2 style="font-weight: normal; font-size: 16px; margin-top: 10px;">{{$project->name_activitie}}</h2>
                        </div>
                        <div>
                            <ul style="margin-left: 0;">
                                @for($i=0; $i <= count($sub_activity['list']); $i++)
                                    @if(!empty($sub_activity['list'][$i]['id_sub_activitie']))
                                        <li><h6 style="font-weight: normal; font-size: 15px;">{{$sub_activity['list'][$i]['name_sub_activitie']}}</h6></li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-6" style="text-align: center; border-right: 1px solid #f1f1f1;">
                        <div style="font-size: 18px; text-align: center;">Страна / Регион:</div>
                        <div style="padding: 10px;">
                            <div style="display: inline-block;">
                                <i class="glyphicon glyphicon-map-marker" style="font-size: 25px;"></i>
                            </div>
                            <div style="display: inline-block;">Россия</div>
                        </div>
                    </div>
                    <div class="col-md-6" style="text-align: center;">
                        <div style="font-size: 18px; text-align: center;">Необходимый бюджет:</div>
                        <div style="padding: 10px;">
                            <div style="display: inline-block;">
                                <i class="glyphicon glyphicon-rub" style="font-size: 20px;"></i>&nbsp;
                            </div>
                            <div style="display: inline-block; font-size: 20px;"><?=$sum;?></div>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <div style="border-top: 1px solid #f1f1f1; margin: 20px -10px 20px -10px;"></div>
                        <div style="padding: 10px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="margin-left: -15px; text-align: left; font-size: 12px; color: #cecece;">Спец размещение:</div>
                                </div>
                                <div class="col-md-6">
                                    <div style="margin-left: -15px; text-align: left; font-size: 12px; color: #cecece;">Реклама:</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="height: 200px; background: #f1f1f1; border: 1px solid #cecece;">

                                </div>
                                <div class="col-md-6" style="height: 200px; background: #f1f1f1; border: 1px solid #cecece;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <div style="border-top: 1px solid #f1f1f1; margin: 20px -10px 20px -10px;"></div>
                        <div style="padding: 10px;">
                            <div class="row">
                                <div class="col-md-12" style="height: 200px; border: 1px solid #cecece;">
                                            @if(isset($project->img_business_proj) AND !empty($project->img_business_proj))

                                                <?php
                                                    $images = json_decode($project->img_business_proj);
                                                ?>
                                                @for($i=0; $i <= count($images); $i++)

                                                    @if(isset($images[$i]) AND !empty($images[$i]))

                                                        @if($i == 0)
                                                            <a href="{{$images[$i]}}" data-fancybox="images">
                                                                <img style="border: none; max-height: 198px;" src="{{$images[$i]}}">
                                                            </a>
                                                        @else
                                                            <a style="display: none;" href="{{$images[$i]}}" data-fancybox="images">
                                                                <img style="max-height: 198px;" src="{{$images[$i]}}">
                                                            </a>
                                                        @endif

                                                    @endif

                                                @endfor

                                            @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div style="border-top: 1px solid #f1f1f1; margin: 20px 20px 20px 20px;"></div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding: 0 20px 0 20px; font-size: 19px;">
                    -&nbsp;Финансовые показатели
                </div>
                <div class="col-md-12" style="padding: 0 20px 0 20px; margin-top: 10px;">
                    <div class="row">
                        <div class="col-md-3" style="text-align: center;">
                            <div style="font-weight: bold;">Прибыль в месяц:</div>
                            <div style="font-size: 18px;">
                                {{$project->profit_sum_business_proj}}&nbsp;
                                <i class="glyphicon glyphicon-rub" style="font-size: 17px;"></i>
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: center; border-left: 1px solid #f1f1f1;">
                            <div style="font-weight: bold;">Оборот в месяц:</div>
                            <div style="font-size: 18px;">
                                {{$project->m_turn_sum_business_proj}}&nbsp;
                                <i class="glyphicon glyphicon-rub" style="font-size: 17px;"></i>
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: center; border-left: 1px solid #f1f1f1;">
                            <div style="font-weight: bold;">Расход в месяц:</div>
                            <div style="font-size: 18px;">
                                {{$project->m_expe_sum_business_proj}}&nbsp;
                                <i class="glyphicon glyphicon-rub" style="font-size: 17px;"></i>
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: center; border-left: 1px solid #f1f1f1;">
                            <div style="font-weight: bold;">Доля бизнеса:</div>
                            <div style="font-size: 18px;">{{$project->proportion_business_proj}}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div style="border-top: 1px solid #f1f1f1; margin: 20px 20px 20px 20px;"></div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding: 0 20px 0 20px; font-size: 18px; text-decoration: underline;">
                    Описание бизнеса / идеи
                </div>
                <div class="col-md-12" style="padding: 0 20px 0 20px; margin-top: 10px;">
                    {{$project->text_business_proj}}
                </div>
            </div>
        </div>
    </div>
    <div id="myModalMessage" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 60px;">
                <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="" style="text-align: center; margin-top: 10px; color: #666; text-decoration: underline;">Сообщение владельцу бизнеса</h4>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body">
                    <div class="block-body-info" id="block-body-info" style="margin: -10px -15px -15px -15px; text-align: center; font-size: 25px; font-weight: bold;">
                    </div>
                    <div style="margin: 35px -15px -15px -15px; /*background: #FFFFCC;*/" id="block-one-click">
                        <div id="block-inputs">
                            <div style="text-align: center; border-top: 1px solid #e5e5e5; margin: 20px;">
                                <input style="margin-bottom: 10px;" type="text" id="theme" placeholder="Тема сообщения" class="form-control">
                                <textarea id="message" style="width: 100%; min-height: 150px; max-height: 150px;" class="form-control"></textarea>
                            </div>
                            <div style="text-align: center;">
                                <div id="send-message-businessman" style="display: inline-block;font-size: 20px;cursor: pointer;height: auto; background: #5cb85c; color: #fff; padding: 7px; margin-top: 15px; margin-bottom: 20px;">Отправить</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="id_advert" value="{{$project->id_business_proj}}">
@endsection
