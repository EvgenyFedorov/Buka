$(document).ready(function(){

    ymaps.ready(init);

    function init() {

        var geolocation = ymaps.geolocation;

        if (geolocation){


            $('#user_country').val(geolocation.country);

            $('#user_region').val(geolocation.region);

            if(geolocation.city == "undefined"){

                $('#user_city').val("0");

            }else{

                $('#user_city').val(geolocation.city);

            }

        }

    }

    $('.select-tarif-investor').click(function(){

        $('#block-message').hide();
        $('#tarif-investor').val($(this).attr("id"));
        $('#myModalRegInvestor').modal("show");

        $('#phone-investor').mask("+7 (999) 999-9999");

    });

    $('.select-tarif-businessman').click(function () {

        $('#block-message-businessman').hide();
        $('#tarif-businessman').val($(this).attr("id"));
        $('#myModalRegBusinessman').modal("show");

        $('#phone-businessman').mask("+7 (999) 999-9999");

    });

    $('#go-registration-investor').click(function(){

        $('input.form-control').css('border', '1px solid #cccccc');

        if($('#fname-investor').val() == ""){

            $('#fname-investor').focus();
            $('#fname-investor').css('border', '1px solid #ff0000');

        }else if($('#name-investor').val() == ""){

            $('#name-investor').focus();
            $('#name-investor').css('border', '1px solid #ff0000');

        }else if($('#mail-investor').val() == ""){

            $('#mail-investor').focus();
            $('#mail-investor').css('border', '1px solid #ff0000');

        }else if($('#phone-investor').val() == ""){

            $('#phone-investor').focus();
            $('#phone-investor').css('border', '1px solid #ff0000');

        }else if($('#passw-investor').val() == ""){

            $('#passw-investor').focus();
            $('#passw-investor').css('border', '1px solid #ff0000');

        }else if($('#passw2-investor').val() == ""){

            $('#passw2-investor').focus();
            $('#passw2-investor').css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../api/user/registration-investor',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    tarif_investor: $('#tarif-investor').val(),
                    phone_investor: $('#phone-investor').val(),
                    mail_investor: $('#mail-investor').val(),
                    name_investor: $('#name-investor').val(),
                    fname_investor: $('#fname-investor').val(),
                    passw_investor: $('#passw-investor').val(),
                    passw2_investor: $('#passw2-investor').val(),
                    user_country: $('#user_country').val(),
                    user_city: $('#user_city').val(),
                    user_region: $('#user_region').val()
                },
                dataType: 'json',
                success: function(return_registration){

                    if(return_registration.error_status == 'false'){

                        $('#block-message').html(return_registration.success_message);
                        $('#block-inputs').hide();
                        $('#block-message').show();

                    }else{

                        alert(return_registration.error_message);

                    }

                }

            });

        }

    });

    $('#go-registration-businessman').click(function(){

        $('input.form-control').css('border', '1px solid #cccccc');

        if($('#fname-businessman').val() == ""){

            $('#fname-businessman').focus();
            $('#fname-businessman').css('border', '1px solid #ff0000');

        }else if($('#name-businessman').val() == ""){

            $('#name-businessman').focus();
            $('#name-businessman').css('border', '1px solid #ff0000');

        }else if($('#mail-businessman').val() == ""){

            $('#mail-businessman').focus();
            $('#mail-businessman').css('border', '1px solid #ff0000');

        }else if($('#phone-businessman').val() == ""){

            $('#phone-businessman').focus();
            $('#phone-businessman').css('border', '1px solid #ff0000');

        }else if($('#passw-businessman').val() == ""){

            $('#passw-businessman').focus();
            $('#passw-businessman').css('border', '1px solid #ff0000');

        }else if($('#passw2-businessman').val() == ""){

            $('#passw2-businessman').focus();
            $('#passw2-businessman').css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../api/user/registration-businessman',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    tarif_investor: $('#tarif-businessman').val(),
                    phone_investor: $('#phone-businessman').val(),
                    mail_investor: $('#mail-businessman').val(),
                    name_investor: $('#name-businessman').val(),
                    fname_investor: $('#fname-businessman').val(),
                    passw_investor: $('#passw-businessman').val(),
                    passw2_investor: $('#passw2-businessman').val(),
                    user_country: $('#user_country').val(),
                    user_city: $('#user_city').val(),
                    user_region: $('#user_region').val()
                },
                dataType: 'json',
                success: function(return_registration){

                    if(return_registration.error_status == 'false'){

                        $('#block-message-businessman').html(return_registration.success_message);
                        $('#block-inputs-businessman').hide();
                        $('#block-message-businessman').show();

                    }else{

                        alert(return_registration.error_message);

                    }

                }

            });

        }

    });

});