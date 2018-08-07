$(document).ready(function(){

    $(function() {
        $("[data-fancybox]").fancybox();
    });

    $('.send-message').click(function () {

        $('#myModalMessage').modal("show");

    });

    $('#send-message-investor').click(function () {

        $('input.form-control').css('border', '1px solid #cccccc');

        if($('#message').val() == ""){

            $('#message').focus();
            $('#message').css('border', '1px solid #ff0000');

        }else if($('#theme').val() == ""){

            $('#theme').focus();
            $('#theme').css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../../api/adverts/send-dialog-investor',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    id_advert: $('#id_advert').val(),
                    theme: $('#theme').val(),
                    message: $('#message').val()
                },
                dataType: 'json',
                success: function(return_dialog){

                    if(return_dialog.error_status == 'false'){

                        location.href= 'http://www.test.1nvest.ru/profile/dialogs/' + return_dialog.ticket_id;

                    }else{

                        alert(return_dialog.error_message);

                    }

                }

            });

        }

    });

    $('.show-phone').click(function () {

        $.ajax({
            url: '../../api/adverts/show-phone-investor',
            type: "POST",
            data: {
                _token: $('#_token').val(),
                id_advert: $(this).attr('id')
            },
            dataType: 'json',
            success: function(return_phone){

                if(return_phone.error_status == 'false'){

                    $('#block-phone').html(return_phone.phone);
                    $('.phone-' + $('#id_advert').val()).hide();
                    $('#block-phone').show();

                }else{

                    alert(return_phone.error_message);

                }

            }

        });

    });

    $('#add-advert-investor').click(function () {

        $('input.form-control').css('border', '1px solid #cccccc');

        if($('#activity').val() == ""){

            $('#activity').focus();
            $('#activity').css('border', '1px solid #ff0000');

        }else if($('#sub-activity').val() == ""){

            $('#sub-activity').focus();
            $('#sub-activity').css('border', '1px solid #ff0000');

        }else if($('#sum-invest').val() == ""){

            $('#sum-invest').focus();
            $('#sum-invest').css('border', '1px solid #ff0000');

        }else if($('#name-advert').val() == ""){

            $('#name-advert').focus();
            $('#name-advert').css('border', '1px solid #ff0000');

        }else if($("textarea[name='mini-description']").val() == ""){

            $("textarea[name='mini-description']").focus();
            $("textarea[name='mini-description']").css('border', '1px solid #ff0000');

        }else if($("textarea[name='full-description']").val() == ""){

            $("textarea[name='full-description']").focus();
            $("textarea[name='full-description']").css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../../api/user/advert/create-advert',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    activity: $('#select-activity').val(),
                    sub_activity: $('#select-sub-activities').val(),
                    sum_invest: $('#sum-invest').val(),
                    name_advert: $('#name-advert').val(),
                    mini_desc: $("textarea[name='mini-description']").val(),
                    full_desc: $("textarea[name='full-description']").val(),
                    notification: $('#select-notification').val(),
                    dop_email: $('#dop-email').val(),
                    dop_phone: $('#dop-phone').val(),
                    load_img: $('#file-upload-advert').val()
                },
                dataType: 'json',
                success: function(return_add_advert){

                    if(return_add_advert.error_status == 'false'){

                        location.href= 'http://www.test.1nvest.ru/profile/adverts/' + return_add_advert.advert_id;

                    }else{

                        alert(return_add_advert.error_message);

                    }

                }

            });

        }

    });

    $('#update-advert-investor').click(function () {

        $('input.form-control').css('border', '1px solid #cccccc');

        if($('#sum-invest').val() == ""){

            $('#sum-invest').focus();
            $('#sum-invest').css('border', '1px solid #ff0000');

        }else if($('#name-advert').val() == ""){

            $('#name-advert').focus();
            $('#name-advert').css('border', '1px solid #ff0000');

        }else if($("textarea[name='mini-description']").val() == ""){

            $("textarea[name='mini-description']").focus();
            $("textarea[name='mini-description']").css('border', '1px solid #ff0000');

        }else if($("textarea[name='full-description']").val() == ""){

            $("textarea[name='full-description']").focus();
            $("textarea[name='full-description']").css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../../api/user/advert/update-advert',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    id_advert: $('#id_advert').val(),
                    activity: $('#select-activity').val(),
                    sub_activity: $('#select-sub-activities').val(),
                    sum_invest: $('#sum-invest').val(),
                    name_advert: $('#name-advert').val(),
                    mini_desc: $("textarea[name='mini-description']").val(),
                    full_desc: $("textarea[name='full-description']").val(),
                    notification: $('#select-notification').val(),
                    dop_email: $('#dop-email').val(),
                    dop_phone: $('#dop-phone').val(),
                    load_img: $('#file-upload-advert').val()
                },
                dataType: 'json',
                success: function(return_update_advert){

                    if(return_update_advert.error_status == 'false'){

                        location.href= 'http://www.test.1nvest.ru/profile/adverts';

                    }else{

                        alert(return_update_advert.error_message);

                    }

                }

            });

        }

    });

    $('.replay-advert').click(function () {

        $.ajax({
            url: '../../api/user/advert/replay-advert',
            type: "POST",
            data: {
                _token: $('#_token').val(),
                id_advert: $(this).attr('id')
            },
            dataType: 'json',
            success: function(return_replay_advert){

                if(return_replay_advert.error_status == 'false'){

                    location.href= 'http://www.test.1nvest.ru/profile/adverts';

                }else{

                    alert(return_replay_advert.error_message);

                }

            }

        });

    });

    $('.arhives-advert').click(function () {

        $.ajax({
            url: '../../api/user/advert/arhives-advert',
            type: "POST",
            data: {
                _token: $('#_token').val(),
                id_advert: $(this).attr('id')
            },
            dataType: 'json',
            success: function(return_arhives_advert){

                if(return_arhives_advert.error_status == 'false'){

                    location.href= 'http://www.test.1nvest.ru/profile/adverts';

                }else{

                    alert(return_arhives_advert.error_message);

                }

            }

        });

    });

    $('#someSwitchOptionSuccess').click(function(){

        if($(this).prop("checked") == false){

            $('#select-notification').val(0);

        }else{

            $('#select-notification').val(1);

        }

    });

    $('#activity').change(function(){

        $('#select-activity').val($(this).val());

        $('#activity').css('border', '1px solid #cccccc');

        if($('#activity').val() == ""){

            $('#activity').focus();
            $('#activity').css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../../api/user/advert/get-sub-activities',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    id_activity: $('#activity').val()
                },
                dataType: 'json',
                success: function(return_subactivities){

                    if(return_subactivities.error_status == 'false'){

                        $('#sub-activity').html(return_subactivities.sub_activities);
                        $('#block-sub-activity').show();

                    }else{

                        alert(return_subactivities.error_message);

                    }

                }

            });

        }

    });

    $('#sub-activity').change(function(){

        $('#activity').attr('disabled', 'disabled');

        var replacement = '[' + $(this).val() + '],';

        if($('#select-sub-activities').val() == ""){

            $('#block-all-sub-activities').show();
            $('#select-sub-activities').val(replacement);

            addVisualSubActivity($(this).val());

        }else{

            var text = $('#select-sub-activities').val();
            $('#select-sub-activities').val(text.replace(replacement, ''));
            $('#select-sub-activities').val($('#select-sub-activities').val() + replacement);

            addVisualSubActivity($(this).val());

        }

        $('.close-visual-sub-activity').click(function () {

            removeVisualSubActivity($(this).attr('name'));

        });

    });

    function addVisualSubActivity(idv) {

        $('#visual-sub-activities-selected').html(
            $('#visual-sub-activities-selected').html() + '<div id="asa_' + idv + '"><div>'
        );

        $('#asa_' + idv).addClass('alert alert-info alert-sub-activities');
        $('#asa_' + idv).html('<a id="csa_' + idv + '">×</a>');

        $('#csa_' + idv)
            .attr('href', '#')
            .attr('data-dismiss', 'alert')
            .attr('aria-label', 'close')
            .attr('title', 'Закрыть')
            .attr('name', idv)
            .addClass('close close-visual-sub-activity');

        $('#asa_' + idv).append('<div id="vsa_' + idv + '">' + $("option[id='sa_" + idv + "']").html() + '</div>');
        $('#vsa_' + idv).addClass('value-sub-activity');

        $("option[id='sa_" + idv + "']").hide();

        $('#sub-activity').prop('selectedIndex',0);

    }
    
    function removeVisualSubActivity(idv) {

        var replacement = '[' + idv + '],';
        var text = $('#select-sub-activities').val();
        $('#select-sub-activities').val(text.replace(replacement, ''));

        $('#asa_' + idv).remove();
        $("option[id='sa_" + idv + "']").show();

        if($('#select-sub-activities').val() == ""){

            $('#block-all-sub-activities').hide();
            $('#activity').removeAttr('disabled');

        }

    }

    $('#btn-uploaded-setting-advert-img').click(function () {

        $('#file').click();

    });

    $('.delte-img-setting-advert').click(function () {

        //$('#img_default_' + $(this).attr('id')).remove();
        //$(this).remove();
        deleteFileImg($(this).attr('id'));

    });

    function deleteFileImg(idi) {

        $.ajax({
            url: '../../api/user/loadimages/deletefile',
            type: "POST",
            data: {
                _token: $('#_token').val(),
                id_img: idi,
                id_advert: $('#id_advert').val(),
                del_img: $('#img_default_' + idi).attr('src'),
                load_img: $('#file-upload-advert').val()
            },
            dataType: 'json',
            success: function(return_delete_img){

                if(return_delete_img.error_status == 'false'){

                    //$('#img_default_' + idi).remove();
                    $('#block-img' + idi).remove();
                    $('#block-upload-result').hide();
                    $('#btn-uploaded-setting-advert-img').show();

                }else{

                    alert(return_delete_img.error_message);

                }

            }

        });

    }

});