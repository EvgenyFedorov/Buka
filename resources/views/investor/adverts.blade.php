@extends('investor.app')

@section('content')
<script src="{{ url('public/js/adverts-investor.js') }}" rel="script" type="text/javascript"></script>
<div class="row setting-row" style="padding: 0 10px 0 10px;">
    @if(isset($projects[0]->id_investor_proj))
        <div class="col-md-12" style="margin-bottom: 20px; text-align: center;">
            <a href="/profile/advert-create" class="btn btn-primary">Добавить объявление</a>
        </div>
        <ul class="nav nav-tabs nav-justified" style="margin-bottom: -1px;">
            <li class="active"><a data-toggle="tab" href="#activ-adverts">Активные</a></li>
            <li><a data-toggle="tab" href="#unactiv-adverts">Ожидающие</a></li>
            <li><a data-toggle="tab" href="#arhives-adverts">Архив</a></li>
        </ul>
        <div class="tab-content">
            <div id="activ-adverts" class="tab-pane fade in active">
                <h3 class="tab-regs">Активные объявления</h3>
                @foreach($projects as $project_row)
                    @if($project_row->status_investor_proj == 1)
                        <?php
                        $bg = ($project_row->type_investor_proj == 0) ? '#FFFFFF;' : '#FFFFE4;';
                        $border = ($project_row->type_investor_proj == 0) ? '#F1F1F1;' : '#CECECE;';
                        ?>
                        <div class="col-md-12" style="margin-bottom: 20px; text-align: center;">
                            <div class="row" style="border: 1px solid <?=$border; ?> margin-bottom: 20px; background: <?=$bg; ?>">
                                <div class="col-md-12">
                                    <div style="margin: 10px 0 10px 0;">
                                        <a style="font-size: 20px;" href="/profile/adverts/{{$project_row->id_investor_proj}}">{{$project_row->title_investor_proj}}</a>
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-right: 1px solid <?=$border; ?>">
                                    <img src="{{$project_row->img_investor_proj}}" style="width: 100%; margin-bottom: 15px;">
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: right;">Просмотров:</div>
                                        <div class="col-md-6" style="text-align: left;">{{$project_row->views_investor_proj}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: right;">Откликов:</div>
                                        <div class="col-md-6" style="text-align: left;">{{$project_row->feedbacks_investor_proj}}</div>
                                    </div>
                                    <div class="row" style="margin: 10px 0 10px 0;">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" style="border-top: 1px solid <?=$border; ?>"></div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row" style="margin: 10px 0 10px 0;">
                                        <div class="col-md-12" style="padding-top: 15px;">
                                            <i class="glyphicon glyphicon-refresh" style="font-size: 19px; margin-right: 20px; color: green;"></i>
                                            <i class="glyphicon glyphicon-cog" style="font-size: 19px; margin-right: 20px;"></i>
                                            <i class="glyphicon glyphicon-trash arhives-advert" id="{{$project_row->id_investor_proj}}" style="margin-right: 20px; font-size: 19px; color: red; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="В архив" data-original-title="В архив"></i>
                                            @if($project_row->type_investor_proj == 0)
                                                <i class="glyphicon glyphicon-fire" style="font-size: 19px; color: orange;"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div id="unactiv-adverts" class="tab-pane fade">
                <h3 class="tab-regs">Ожидающие объявления</h3>
                @foreach($projects as $project_row)
                    @if($project_row->status_investor_proj == 0 OR $project_row->status_investor_proj > 2)
                        <?php
                        $bg = ($project_row->type_investor_proj == 0) ? '#FFFFFF;' : '#FFFFE4;';
                        $border = ($project_row->type_investor_proj == 0) ? '#F1F1F1;' : '#CECECE;';
                        ?>
                        <div class="col-md-12" style="margin-bottom: 20px; text-align: center;">
                            <div class="row" style="border: 1px solid <?=$border; ?> margin-bottom: 20px; background: <?=$bg; ?>">
                                <div class="col-md-12">
                                    @if($project_row->status_investor_proj == 0)
                                        <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #999999;">
                                            Объявление ожидает оплату
                                        </div>
                                    @elseif($project_row->status_investor_proj == 3)
                                        <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #f0ad4e;">
                                            Объявление на модерации
                                        </div>
                                    @elseif($project_row->status_investor_proj == 4)
                                        <div style="margin: 10px 0 10px 0; display: inline-block; padding: 7px; color: #ffffff; background: #f24943;">
                                            Объявление отклонено
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div style="margin: 10px 0 10px 0;">
                                        <a style="font-size: 20px;" href="/profile/adverts/{{$project_row->id_investor_proj}}">{{$project_row->title_investor_proj}}</a>
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-right: 1px solid <?=$border; ?>">
                                    <img src="{{$project_row->img_investor_proj}}" style="width: 100%; margin-bottom: 15px;">
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: right;">Просмотров:</div>
                                        <div class="col-md-6" style="text-align: left;">{{$project_row->views_investor_proj}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: right;">Откликов:</div>
                                        <div class="col-md-6" style="text-align: left;">{{$project_row->feedbacks_investor_proj}}</div>
                                    </div>
                                    <div class="row" style="margin: 10px 0 10px 0;">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" style="border-top: 1px solid <?=$border; ?>"></div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row" style="margin: 10px 0 10px 0;">
                                        @if($project_row->status_investor_proj == 0)
                                            <div class="col-md-12" style="padding-top: 8px;">
                                                <a style="text-decoration: none; font-size: 20px;" href="/profile/adverts/{{$project_row->id_investor_proj}}">
                                                    <i class="glyphicon glyphicon-cog" style="font-size: 19px;"></i>
                                                </a>
                                                <i style="margin-right: 20px;"></i>
                                                <i class="glyphicon glyphicon-trash arhives-advert" id="{{$project_row->id_investor_proj}}" style="font-size: 19px; color: red; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="В архив" data-original-title="В архив"></i>
                                                <i style="margin-right: 20px;"></i>
                                                <a style="border: 1px solid #cecece; padding: 10px 10px 8px 10px; text-decoration: none; font-size: 20px; color: #666666;" href="/profile/payment/{{$project_row->id_investor_proj}}">
                                                    <span style="font-weight: bold; font-size: 25px;">500</span>
                                                    <i class="glyphicon glyphicon-rub" style="font-size: 19px; color: green;"></i>
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-md-12" style="padding-top: 15px;">
                                                <a style="text-decoration: none; font-size: 20px;" href="/profile/adverts/{{$project_row->id_investor_proj}}">
                                                    <i class="glyphicon glyphicon-cog" style="font-size: 19px;"></i>
                                                </a>
                                                <i style="margin-right: 20px;"></i>
                                                <i class="glyphicon glyphicon-trash arhives-advert" id="{{$project_row->id_investor_proj}}" style="font-size: 19px; color: red; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="В архив" data-original-title="В архив"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div id="arhives-adverts" class="tab-pane fade">
                <h3 class="tab-regs">Архив</h3>
                @foreach($projects as $project_row)
                    @if($project_row->status_investor_proj == 2)
                        <?php
                        $bg = ($project_row->type_investor_proj == 0) ? '#FFFFFF;' : '#FFFFE4;';
                        $border = ($project_row->type_investor_proj == 0) ? '#F1F1F1;' : '#CECECE;';
                        ?>
                        <div class="col-md-12" style="margin-bottom: 20px; text-align: center;">
                            <div class="row" style="border: 1px solid <?=$border; ?> margin-bottom: 20px; background: <?=$bg; ?>">
                                <div class="col-md-12">
                                    <div style="margin: 10px 0 10px 0;">
                                        <a style="font-size: 20px;" href="/profile/adverts/{{$project_row->id_investor_proj}}">{{$project_row->title_investor_proj}}</a>
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-right: 1px solid <?=$border; ?>">
                                    <img src="{{$project_row->img_investor_proj}}" style="width: 100%; margin-bottom: 15px;">
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: right;">Просмотров:</div>
                                        <div class="col-md-6" style="text-align: left;">{{$project_row->views_investor_proj}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: right;">Откликов:</div>
                                        <div class="col-md-6" style="text-align: left;">{{$project_row->feedbacks_investor_proj}}</div>
                                    </div>
                                    <div class="row" style="margin: 10px 0 10px 0;">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" style="border-top: 1px solid <?=$border; ?>"></div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row" style="margin: 10px 0 10px 0;">
                                        <div class="col-md-12" style="padding-top: 15px;">
                                            <i id="{{$project_row->id_investor_proj}}" class="glyphicon glyphicon-play-circle replay-advert" title="Возобновить" style="font-size: 22px; margin-right: 20px; color: green; cursor: pointer;"></i>
                                            <i class="glyphicon glyphicon-trash" style="font-size: 19px; color: red;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
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
@endsection
