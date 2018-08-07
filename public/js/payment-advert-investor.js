$(document).ready(function(){

    $('.type-advert-selet').click(function(){

        var styles_border = [0, {border: "1px solid red"}, {border: "1px solid green"}, {border: "1px solid #cecece"}];
        var styles_background = [0, {background: "#FFFFCC"}, {background: "#fffff1"}, {background: "#FFFFFF"}];

        $('.type-advert-selet').removeClass('active');
        $('.block-type-advert').css('box-shadow', '0 0 0 rgba(0,0,0,0.5)');

        $(this).addClass('active');
        $('#block-type-advert-' + $(this).attr('id')).css('box-shadow', '0 0 10px rgba(0,0,0,0.5)');

        $('#sum-pay-advert').html($(this).attr('name'));

        $('#block-pre-advert').css('border', styles_border[$(this).attr('id')].border);
        $('#block-pre-advert').css('background', styles_background[$(this).attr('id')].background);

        $('#type_adverts').val($(this).attr('id'));

        $('.block-type-payment').show();

    });

    $('.btn-payment-go').click(function () {

        $('input.form-control').css('border', '1px solid #cccccc');

        if($('#select-type-payment').val() == ""){

            $('#select-type-payment').focus();
            $('#select-type-payment').css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../../api/user/payment/get-payment',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    id_advert: $('#id_advert').val(),
                    type_adverts: $('#type_adverts').val(),
                    type_payment: $('#select-type-payment').val()
                },
                dataType: 'json',
                success: function(return_payment_advert){

                    if(return_payment_advert.error_status == 'false'){

                        location.href= 'http://www.test.1nvest.ru/profile/adverts';

                    }else{

                        alert(return_payment_advert.error_message);

                    }

                }

            });

        }

    });

});