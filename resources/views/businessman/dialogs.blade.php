@extends('businessman.app')

@section('content')
    <div class="row setting-row" style="padding: 0 10px 0 10px;">
        @if(isset($dialogs[0]->id_ticket))
            <table class="table table-hover table-strider table-bordered">
                @foreach($dialogs as $dialog)
                    <tr>
                        <td style="padding: 0; text-align: left;">
                            <a style="padding: 40px 10px 20px 10px; display: block; width: 100%; height: 100%;" href="/profile/dialogs/{{$dialog->id_ticket}}">
                                <div>{{$dialog->theme_ticket}}</div>
                            </a>
                            <div style="font-size: 13px; color: #cecece; text-decoration: none; position: absolute; margin-top: -65px; margin-left: 10px;">
                                <i class="glyphicon glyphicon-time"></i>&nbsp;
                                {{$dialog->updated_ticket_at}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div style="text-align: center;">
                Объявления отсутствуют!<br>
                <a href="/profile/advert-create" class="btn btn-primary" style="margin-top: 20px;">Добавить объявление</a>
            </div>
        @endif
    </div>
@endsection
