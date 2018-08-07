@extends('layouts.app')

@section('content')
<script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="{{ url('public/js/action_maskinputs.js') }}"></script>
<script src="{{ url('public/js/registr.js') }}" rel="script" type="text/javascript"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#home">Зарегистрироваться как Инвестор</a></li>
                <li><a data-toggle="tab" href="#menu1">Зарегистрироваться как Владелец бизнеса</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3 class="tab-regs">Регистрация Инвестора</h3>
                    <table class="table table-bordered tarif-table-registration">
                        <tr class="head-tarif-table-registration">
                            <th>Преимущества аккаунтов</th>
                            <th>Investor Silver</th>
                            <th class="col-middle-tarif">Investor Gold</th>
                            <th class="col-top-tarif">Investor Platinum</th>
                        </tr>
                        <tr>
                            <td>Стоимость объявлений</td>
                            <td>500 руб. / за 1</td>
                            <td class="col-middle-tarif">Бесплатно</td>
                            <td class="col-top-tarif">Бесплатно</td>
                        </tr>
                        <tr>
                            <td>Лимит объявлений</td>
                            <td>Без ограничений</td>
                            <td class="col-middle-tarif">15</td>
                            <td class="col-top-tarif">Без ограничений</td>
                        </tr>
                        <tr>
                            <td>Ручное обновление</td>
                            <td>1 раз в день</td>
                            <td class="col-middle-tarif">Каждые 2 часа</td>
                            <td class="col-top-tarif">Каждый час</td>
                        </tr>
                        <tr>
                            <td>Автоматическое обновление</td>
                            <td>Отсутствует</td>
                            <td class="col-middle-tarif">1 раз в день</td>
                            <td class="col-top-tarif">Каждые 2 часа</td>
                        </tr>
                        <tr>
                            <td>Уведомления на Email</td>
                            <td>+</td>
                            <td class="col-middle-tarif">+</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Уведомления о сообщениях</td>
                            <td>-</td>
                            <td class="col-middle-tarif">+</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Предварительная проверка проектов</td>
                            <td>-</td>
                            <td class="col-middle-tarif">+</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Уведомления о новых проектах</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Email рассылка по нашей базе</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Личный &laquo;Брендированный Лендинг&raquo;</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Спецразмещение объявлений</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Помощь в подборе проектов</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Личный Менеджер</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Срок действия</td>
                            <td>Без ограничения</td>
                            <td class="col-middle-tarif">5 мес.</td>
                            <td class="col-top-tarif">1 год</td>
                        </tr>
                        <tr class="">
                            <td><strike>Старая цена</strike></td>
                            <td><strike>Бесплатный доступ</strike></td>
                            <td class="col-middle-tarif"><strike>7&nbsp;500 руб.</strike></td>
                            <td class="col-top-tarif"><strike>14&nbsp;500 руб.</strike></td>
                        </tr>
                        <tr class="">
                            <td class="success" style="text-decoration: underline;"><b>Цена со скидкой</b></td>
                            <td class="success">Бесплатный доступ</td>
                            <td class="col-middle-tarif" style="text-decoration: underline;"><b>5&nbsp;000 руб.</b></td>
                            <td class="col-top-tarif" style="text-decoration: underline;"><b>10&nbsp;000 руб.</b></td>
                        </tr>
                        <tr class="">
                            <td></td>
                            <td><div class="btn btn-default select-tarif-investor" id="1">Выбрать</div></td>
                            <td class="col-middle-tarif"><div class="btn btn-warning select-tarif-investor" id="2">Выбрать</div></td>
                            <td class="col-top-tarif"><div class="btn btn-info select-tarif-investor" id="3">Выбрать</div></td>
                        </tr>
                    </table>
                    <div id="myModalRegInvestor" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content" style="margin-top: 60px;">
                                <!-- Заголовок модального окна -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="" style="text-align: center; margin-top: 10px; color: #666; text-decoration: underline;">Форма регистрации Инвестора</h4>
                                </div>
                                <!-- Основное содержимое модального окна -->
                                <div class="modal-body">
                                    <div class="block-body-info" id="block-body-info" style="margin: -10px -15px -15px -15px; text-align: center; font-size: 25px; font-weight: bold;">
                                        <!--div id="div_block_img_pay_type" style="display: none;">
                                            <img src="/public/img/BankSberBankQiwi.gif" id="img_select_pay_type">
                                        </div>
                                        <div>
                                            <div style="font-weight: normal; color: #999;">К оплате:</div>
                                            <span id="block_sum"></span>&nbsp;руб.
                                            <div style="margin-top: 10px; text-decoration: underline; color: #f00; font-size: 15px;">
                                                Оплачивая Online<br> Вы помогаете детям. <img src="/public/img/hart.png" style="display: inline-block; width: 20px; margin-right: -20px; margin-top: -20px;">
                                            </div>
                                        </div-->
                                    </div>
                                    <div style="margin: 35px -15px -15px -15px; /*background: #FFFFCC;*/" id="block-one-click">
                                        <div id="block-message" style="display: none; padding: 0 20px 20px 20px; text-align: center; font-size: 20px;"></div>
                                        <div id="block-inputs">
                                            <div style="text-align: center; border-top: 1px solid #e5e5e5; margin-top: 20px;">
                                                <input placeholder="Фамилия" id="fname-investor" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Имя" id="name-investor" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Email" id="mail-investor" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="+7(499) 999-9999" id="phone-investor" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Пароль" id="passw-investor" type="password" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Повторите пароль" id="passw2-investor" type="password" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input type="hidden" id="tarif-investor" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                            </div>
                                            <div style="text-align: center;">
                                                <a style="margin-top: 10px; display: block; font-size: 11px;" href="#">Нажимая кнопку оплатить вы принимаете соглашение</a>
                                                <div id="go-registration-investor" style="display: inline-block;font-size: 20px;cursor: pointer;height: auto; background: #cecece; /*background: #f24943; color: #fff;*/ padding: 7px; margin-top: 15px; margin-bottom: 20px;">Зарегистрироваться</div>
                                                <!--div>
                                                    <i class="glyphicon glyphicon-hand-up" style="font-size: 30px; margin-top: -7px;"></i>
                                                </div-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3 class="tab-regs">Регистрация владельца бизнеса</h3>
                    <table class="table table-bordered tarif-table-registration">
                        <tr class="head-tarif-table-registration">
                            <th>Преимущества аккаунтов</th>
                            <th>Business Silver</th>
                            <th class="col-middle-tarif">Business Gold</th>
                            <th class="col-top-tarif">Business Platinum</th>
                        </tr>
                        <tr>
                            <td>Стоимость объявлений</td>
                            <td>250 руб. / за 1</td>
                            <td class="col-middle-tarif">Бесплатно</td>
                            <td class="col-top-tarif">Бесплатно</td>
                        </tr>
                        <tr>
                            <td>Лимит объявлений</td>
                            <td>Без ограничений</td>
                            <td class="col-middle-tarif">15</td>
                            <td class="col-top-tarif">Без ограничений</td>
                        </tr>
                        <tr>
                            <td>Ручное обновление</td>
                            <td>1 раз в день</td>
                            <td class="col-middle-tarif">Каждые 2 часа</td>
                            <td class="col-top-tarif">Каждый час</td>
                        </tr>
                        <tr>
                            <td>Автоматическое обновление</td>
                            <td>Отсутствует</td>
                            <td class="col-middle-tarif">1 раз в день</td>
                            <td class="col-top-tarif">Каждые 2 часа</td>
                        </tr>
                        <tr>
                            <td>Уведомления на Email</td>
                            <td>+</td>
                            <td class="col-middle-tarif">+</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Уведомления о сообщениях</td>
                            <td>-</td>
                            <td class="col-middle-tarif">+</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Предварительная проверка инвесторов</td>
                            <td>-</td>
                            <td class="col-middle-tarif">+</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Уведомления о новых инвесторах</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Email рассылка по инвесторам</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Личный &laquo;Брендированный Лендинг&raquo;</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Спецразмещение объявлений</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Помощь в подборе инвесторов</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Личный Менеджер</td>
                            <td>-</td>
                            <td class="col-middle-tarif">-</td>
                            <td class="col-top-tarif">+</td>
                        </tr>
                        <tr>
                            <td>Срок действия</td>
                            <td>Без ограничения</td>
                            <td class="col-middle-tarif">5 мес.</td>
                            <td class="col-top-tarif">1 год</td>
                        </tr>
                        <tr class="">
                            <td><strike>Старая цена</strike></td>
                            <td><strike>Бесплатный доступ</strike></td>
                            <td class="col-middle-tarif"><strike>3&nbsp;750 руб.</strike></td>
                            <td class="col-top-tarif"><strike>7&nbsp;500 руб.</strike></td>
                        </tr>
                        <tr class="">
                            <td class="success" style="text-decoration: underline;"><b>Цена со скидкой</b></td>
                            <td class="success">Бесплатный доступ</td>
                            <td class="col-middle-tarif" style="text-decoration: underline;"><b>2&nbsp;500 руб.</b></td>
                            <td class="col-top-tarif" style="text-decoration: underline;"><b>5&nbsp;000 руб.</b></td>
                        </tr>
                        <tr class="">
                            <td></td>
                            <td><div class="btn btn-default select-tarif-businessman" id="4">Выбрать</div></td>
                            <td class="col-middle-tarif"><div class="btn btn-warning select-tarif-businessman" id="5">Выбрать</div></td>
                            <td class="col-top-tarif"><div class="btn btn-info select-tarif-businessman" id="6">Выбрать</div></td>
                        </tr>
                    </table>
                    <div id="myModalRegBusinessman" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content" style="margin-top: 60px;">
                                <!-- Заголовок модального окна -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="" style="text-align: center; margin-top: 10px; color: #666; text-decoration: underline;">Форма регистрации Владельца бизнеса</h4>
                                </div>
                                <!-- Основное содержимое модального окна -->
                                <div class="modal-body">
                                    <div class="block-body-info" id="block-body-info" style="margin: -10px -15px -15px -15px; text-align: center; font-size: 25px; font-weight: bold;">
                                        <!--div id="div_block_img_pay_type" style="display: none;">
                                            <img src="/public/img/BankSberBankQiwi.gif" id="img_select_pay_type">
                                        </div>
                                        <div>
                                            <div style="font-weight: normal; color: #999;">К оплате:</div>
                                            <span id="block_sum"></span>&nbsp;руб.
                                            <div style="margin-top: 10px; text-decoration: underline; color: #f00; font-size: 15px;">
                                                Оплачивая Online<br> Вы помогаете детям. <img src="/public/img/hart.png" style="display: inline-block; width: 20px; margin-right: -20px; margin-top: -20px;">
                                            </div>
                                        </div-->
                                    </div>
                                    <div style="margin: 35px -15px -15px -15px; /*background: #FFFFCC;*/" id="block-one-click">
                                        <div id="block-message-businessman" style="display: none; padding: 0 20px 20px 20px; text-align: center; font-size: 20px;"></div>
                                        <div id="block-inputs-businessman">
                                            <div style="text-align: center; border-top: 1px solid #e5e5e5; margin-top: 20px;">
                                                <input placeholder="Фамилия" id="fname-businessman" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Имя" id="name-businessman" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Email" id="mail-businessman" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="+7(499) 999-9999" id="phone-businessman" type="text" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Пароль" id="passw-businessman" type="password" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input placeholder="Повторите пароль" id="passw2-businessman" type="password" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input type="hidden" id="tarif-businessman" class="form-control" style="margin-top: 20px; width: 60%; display: inline-block; font-size: 18px;">
                                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                            <div style="text-align: center;">
                                                <a style="margin-top: 10px; display: block; font-size: 11px;" href="#">Нажимая кнопку оплатить вы принимаете соглашение</a>
                                                <div id="go-registration-businessman" style="display: inline-block;font-size: 20px;cursor: pointer;height: auto; background: #cecece; /*background: #f24943; color: #fff;*/ padding: 7px; margin-top: 15px; margin-bottom: 20px;">Зарегистрироваться</div>
                                                <!--div>
                                                    <i class="glyphicon glyphicon-hand-up" style="font-size: 30px; margin-top: -7px;"></i>
                                                </div-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer footer_hide" id="footer_form_hide" style="text-align: left; display: none;">
                                    <input type="hidden" value="" name="sum_pre_out" id="sum_pre_out">
                                    <input type="hidden" value="" name="pay_type" id="pay_type">
                                    <input type="hidden" value="0" name="m_sum_all_deliv" id="m_sum_all_deliv">
                                    <input type="hidden" value="0" name="c_sum_all_deliv" id="c_sum_all_deliv">
                                    <input type="hidden" value="0" name="is_msk" id="is_msk">
                                    <input type="hidden" value="0" name="user_country" id="user_country">
                                    <input type="hidden" value="0" name="user_region" id="user_region">
                                    <input type="hidden" value="0" name="user_city" id="user_city">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--div class="panel panel-default">
                <div class="panel-heading">Регистрация пользователя</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div-->
        </div>
    </div>
</div>
@endsection
