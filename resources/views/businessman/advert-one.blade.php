@extends('businessman.app')

@section('content')
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="{{ url('public/js/adverts-businessman.js') }}" rel="script" type="text/javascript"></script>
    <div class="row setting-row" style="padding: 0 10px 0 10px;">
        @if(isset($projects->id_business_proj))
            <?php
                $bg = ($projects->type_business_proj == 0) ? '#FFFFFF;' : '#FFFFE4;';
                $border = ($projects->type_business_proj == 0) ? '#F1F1F1;' : '#CECECE;';
            ?>
            <div class="col-md-12" style="margin-bottom: -30px; text-align: center;">
                <div class="row" style="border: 1px solid <?=$border; ?> margin-bottom: 20px; background: <?=$bg; ?>">
                    <div class="col-md-12">
                        @if($projects->status_business_proj == 0)
                            <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #999999;">
                                Объявление ожидает оплату
                            </div>
                        @elseif($projects->status_business_proj == 1)
                            <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #0CB665;">
                                Активное объявление
                            </div>
                        @elseif($projects->status_business_proj == 2)
                            <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #2a85a0;">
                                Объявление в архиве
                            </div>
                        @elseif($projects->status_business_proj == 3)
                            <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #f0ad4e;">
                                Объявление на модерации
                            </div>
                        @elseif($projects->status_business_proj == 4)
                            <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #f24943;">
                                Объявление отклонено
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6" style="border-right: 1px solid <?=$border; ?>">
                        @if(isset($imgs[0]) AND !empty($imgs[0]))
                            <?php
                            $display = 'display: none;';
                            ?>
                        @else
                            <?php
                            $display = 'display: block;';
                            ?>
                        @endif

                        <!--div>
                            <div id="btn-uploaded-setting-advert-img" style="<?=$display; ?> position: absolute; margin-left: 50px; margin-top: 10px; font-size: 17px; cursor: pointer; height: auto; background: #f0ad4e; color: #fff; padding: 7px;">Загрузить фото</div>&nbsp;
                            <div id="block-upload-result" style="border: 1px solid #f1f1f1; margin-bottom: 15px; margin-top: -20px; display: none;"></div>
                            <form style="display: none;" action="" enctype="multipart/form-data" method="POST">
                                <input id="file" type="file" multiple="multiple" name="file[]" />
                                <div id="preloader"><img alt="loader" src="preloader.gif" /></div>
                                <div id="info"></div>
                            </form>
                        </div-->
                        <div class="row setting-row show-block-btn-upload-file" style="<?=$display; ?> position: absolute; margin-left: 50px; margin-top: 10px; font-size: 17px; cursor: pointer; height: auto; color: #fff; padding: 7px;">
                            <div class="col-md-8 setting-input" style="">
                                <div id="btn-uploaded-photo" style="margin-top: 8px; display: inline-block; font-size: 17px; cursor: pointer; height: auto; background: #f0ad4e; color: #fff; padding: 7px; width: 140px;">
                                    Загрузить фото
                                </div>&nbsp;
                            </div>
                        </div>
                        <div class="row setting-row">
                            <div class="col-md-12 setting-label-input" id="block-upload-result" style="margin-top: 20px; text-align: left;">

                                <?php
                                    $img_values = '';
                                ?>

                                @if(isset($imgs[0]) AND !empty($imgs[0]))

                                    @foreach($imgs as $img)

                                        <div id="block-img{{$img->id_img}}" style="border: 1px solid #f1f1f1; display: inline-block; width:45%; margin-right: 10px; margin-bottom: 10px;">
                                            <a class="close delete-uploaded-img-start" id="cui_{{$img->id_img}}" href="#" data-dismiss="alert" aria-label="close" title="Удалить" name="{{$img->id_img}}" style="font-size: 25px;">×</a>
                                            <img id="img{{$img->id_img}}" src="{{$img->path_img}}" style="width: 100%;">
                                        </div>

                                        <?php
                                            $img_values .= '[' . $img->path_img . '],';
                                        ?>

                                    @endforeach

                                @endif

                            </div>
                            <form style="display: none;" action="" enctype="multipart/form-data" method="POST">
                                <input id="file" type="file" multiple="multiple" name="file[]" />
                                <div id="preloader"><img alt="loader" src="preloader.gif" /></div>
                                <div id="info"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6" style="text-align: right;">Просмотров:</div>
                            <div class="col-md-6" style="text-align: left;">{{$projects->views_business_proj}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="text-align: right;">Откликов:</div>
                            <div class="col-md-6" style="text-align: left;">{{$projects->feedbacks_business_proj}}</div>
                        </div>
                        <div class="row" style="margin: 10px 0 10px 0;">
                            <div class="col-md-1"></div>
                            <div class="col-md-10" style="border-top: 1px solid <?=$border; ?>"></div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row" style="margin: 10px 0 10px 0;">
                            <div class="col-md-12" style="padding-top: 15px;">
                                @if($projects->status_business_proj == 2)
                                    <i id="{{$projects->id_business_proj}}" class="glyphicon glyphicon-play-circle replay-advert" style="font-size: 40px; color: green; cursor: pointer;"></i>
                                    <div>Возобновить</div>
                                @else
                                    <i class="glyphicon glyphicon-refresh" style="font-size: 19px; margin-right: 20px; color: green;"></i>
                                    <i class="glyphicon glyphicon-cog" style="font-size: 19px; margin-right: 20px;"></i>
                                    <i class="glyphicon glyphicon-trash" style="font-size: 19px; margin-right: 20px; color: red;"></i>
                                    @if($projects->type_business_proj == 0)
                                        <i class="glyphicon glyphicon-fire" style="font-size: 19px; color: orange;"></i>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="margin-bottom: -10px; margin-top: 30px;">
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Раздел:</div>
                    <div class="col-md-8 setting-input">
                        <input disabled type="text" class="form-control" id="dop-email" value="{{$activity->name_activitie}}">
                    </div>
                </div>
                <div class="row setting-row" id="block-sub-activity" style="">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Категории</div>
                    <div class="col-md-12" id="block-all-sub-activities" style="">
                        <div id="visual-sub-activities-selected" style="margin-top: 20px; height: 150px; overflow: auto; border: 1px solid #f1f1f1; padding: 10px;">
                            @for($i=0; $i <= count($sub_activity['list']); $i++)
                                @if(!empty($sub_activity['list'][$i]['id_sub_activitie']))

                                    <div id="asa_{{$sub_activity['list'][$i]['id_sub_activitie']}}" class="alert alert-info alert-sub-activities">
                                    <!--a id="csa_{{$sub_activity['list'][$i]['id_sub_activitie']}}" href="#" data-dismiss="alert" aria-label="close" title="удалить">×</a-->
                                        <div class="value-sub-activity" id="vsa_{{$sub_activity['list'][$i]['id_sub_activitie']}}">{{$sub_activity['list'][$i]['name_sub_activitie']}}</div>
                                    </div>

                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input">Доп. Email адрес:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="dop-email" value="{{$projects->email_business_proj}}">
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input">Доп. Телефон:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="dop-phone" value="{{$projects->phone_business_proj}}">
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Сумма инвестиций:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="sum-invest" value="{{$projects->sum_business_proj}}">
                    </div>
                </div>
                <!-- -->
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Прибыль в месяц:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="sum-profit" value="{{$projects->profit_sum_business_proj}}">
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Оборот в месяц:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="sum-turn" value="{{$projects->m_turn_sum_business_proj}}">
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Расход в месяц:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="sum-expe" value="{{$projects->m_expe_sum_business_proj}}">
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Доля в процентах:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="sum-proportion" value="{{$projects->proportion_business_proj}}">
                    </div>
                </div>
                <!-- -->
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"></div>
                    <div class="col-md-8 setting-input">
                        <div class="material-switch pull-left" style="margin-top: 7px;">
                            @if($projects->notification_business_proj > 0)
                                <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox" checked/>
                            @else
                                <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
                            @endif
                            <label for="someSwitchOptionSuccess" class="label-success autopilot_select"></label>
                            <div style="display: inline-block; margin-left: 20px;">Получать уведомления</div>
                        </div>
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Название:</div>
                    <div class="col-md-8 setting-input">
                        <input type="text" class="form-control" id="name-advert" value="{{$projects->title_business_proj}}">
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Краткое описание:</div>
                    <div class="col-md-8 setting-input">
                        <textarea name="mini-description" style="min-width: 100%; max-width: 100%; min-height: 100px; max-height: 100px;" class="form-control">{{$projects->desc_business_proj}}</textarea>
                    </div>
                </div>
                <div class="row setting-row">
                    <div class="col-md-4 setting-label-input"><span class="required-input">*&nbsp;</span>Полное описание:</div>
                    <div class="col-md-8 setting-input">
                        <textarea name="full-description" style="min-width: 100%; max-width: 100%; min-height: 100px; max-height: 100px;" class="form-control">{{$projects->text_business_proj}}</textarea>
                    </div>
                </div>
                <div class="row setting-row" style="margin-top: 20px; padding-top: 20px;">
                    <div class="col-md-12" style="text-align: right;">
                        <a class="btn btn-success" id="update-advert-business">Сохранить объявление</a>
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
    <input type="hidden" id="select-activity" value="{{$projects->id_business_activity}}">
    <input type="hidden" id="select-sub-activities" value="{{$sub_activity['input']}}">
    <input type="hidden" id="select-notification" value="{{$projects->notification_business_proj}}">
    <input type="hidden" id="id_advert" value="{{$projects->id_business_proj}}">
    <input type="hidden" id="file-upload-advert" value="<?=$img_values; ?>">
    <script src="{{ url('public/js/load-images-businessman.js') }}" rel="script" type="text/javascript"></script>
@endsection
