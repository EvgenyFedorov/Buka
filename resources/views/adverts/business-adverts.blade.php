@extends('adverts.app-business-adverts')

@section('content')
    <script src="{{ url('public/js/adverts-business.js') }}" rel="script" type="text/javascript"></script>
    <div class="row setting-row" style="padding: 0;">
        @foreach($projects as $project)
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
            <div class="col-md-4" style="padding-left: 15px; padding-right: 15px; margin-bottom: 20px;">
                <div style="border: 1px solid #f1f1f1;" class="block-adverts">
                    <table style="width: 100%; padding: 0 0 10px 0;">
                        <tr>
                            <td style="text-align: center; font-size: 16px; height: 80px;">
                                <a href="/businessman-adverts/{{$project->id_business_proj}}" style="vertical-align: middle;">{{$project->title_business_proj}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php
                                $images1 = json_decode($project->img_business_proj);
                                ?>
                                <img src="<?=$images1[0]; ?>" style="width: 100%; height: 114.8px; margin-bottom: 15px;">
                            </td>
                        </tr>
                    </table>
                    <div style="padding: 10px;">
                        <div style="display: inline-block;">
                            <i class="glyphicon glyphicon-map-marker" style="font-size: 25px;"></i>
                        </div>
                        <div style="display: inline-block;">Россия</div>
                    </div>
                    <div style="padding: 10px;">
                        <div style="display: inline-block; vertical-align: top;">
                            <i class="glyphicon glyphicon-screenshot" style="font-size: 25px; vertical-align: middle;"></i>&nbsp;
                        </div>
                        <div style="display: inline-block; min-height: 40px; max-height: 60px; width: 200px;">
                            {{$project->name_activitie}}
                        </div>
                    </div>
                    <div style="padding: 10px;">
                        <div style="display: inline-block;">
                            <i class="glyphicon glyphicon-rub" style="font-size: 20px;"></i>&nbsp;
                        </div>
                        <div style="display: inline-block; font-size: 20px;"><?=$sum;?></div>
                    </div>
                    <div style="padding: 10px; text-align: center; color: #999999; font-size: 16px;">
                        {{$project->user_info_f_name}}&nbsp;{{$project->user_info_name}}
                    </div>
                    <div style="padding: 10px; text-align: center;">
                        <a class="btn btn-success" href="/businessman-adverts/{{$project->id_business_proj}}">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
@endsection
