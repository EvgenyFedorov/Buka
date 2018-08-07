@extends('investor.app')

@section('content')
<script src="{{ url('public/js/dialogs-investor.js') }}" rel="script" type="text/javascript"></script>
<div class="row setting-row" style="padding: 0 10px 0 10px;">
    @if(isset($dialog[0]->id_ticket))
        <div class="col-md-12" style="margin-bottom: 20px; text-align: left; font-size: 20px;">
            {{$dialog[0]->theme_ticket}}
        </div>
        <div id="block-dialog-messages" style="padding: 10px 10px 10px 5px; min-height: 300px; max-height: 400px; overflow: auto; margin-right: -16px; margin-left: -15px; border-top: 1px solid #cecece; border-bottom: 1px solid #cecece;">
            @foreach($dialog as $message)
                @if($user_info[0]->id == $message->id_user_info)
                    <div class="block_message_from">
                        <div class="message_from">
                            <div class="message_from dialog_from">
                                <p>{{$message->text_message}}</p>
                            </div>
                        </div>
                        <div class="message_time_from">
                            {{$message->updated_message_at}}&nbsp;
                            <i class="glyphicon glyphicon-time"></i>
                        </div>
                    </div>
                @else
                    <div class="block_message_to">
                        <div class="message_to">
                            <div class="message_to dialog_to">
                                <p>{{$message->text_message}}</p>
                            </div>
                        </div>
                        <div class="message_time_to">
                            <i class="glyphicon glyphicon-time"></i>&nbsp;
                            {{$message->updated_message_at}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div id="block-textarea-message" style="min-width: 100%; max-width: 100%;">
            <textarea class="form-control textarea-message" style="min-height: 100px; max-height: 100px; width: 100%; margin-top: 15px;"></textarea>
            <div style="text-align: right; margin: 20px 0 20px 0;">
                <div class="btn btn-success" id="send-message">Отправить</div>
            </div>
            <input type="hidden" id="id_dialog" value="{{$dialog[0]->id_ticket}}">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        </div>
    @else
        <div style="text-align: center;">
            Объявления отсутствуют!<br>
            <a href="/profile/advert-create" class="btn btn-primary" style="margin-top: 20px;">Добавить объявление</a>
        </div>
    @endif
</div>
@endsection
