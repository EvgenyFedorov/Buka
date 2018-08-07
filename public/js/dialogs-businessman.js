$(document).ready(function(){

    $('.textarea-message').css('max-width', $('#block-textarea-message').css('width'));
    $('.textarea-message').css('min-width', $('#block-textarea-message').css('width'));

    var block = document.getElementById("block-dialog-messages");
    block.scrollTop = block.scrollHeight;

    $('#send-message').click(function () {

        $('input.form-control').css('border', '1px solid #cccccc');

        if($('.textarea-message').val() == ""){

            $('.textarea-message').focus();
            $('.textarea-message').css('border', '1px solid #ff0000');

        }else{

            $.ajax({
                url: '../../api/user/send-message',
                type: "POST",
                data: {
                    _token: $('#_token').val(),
                    id_dialog: $('#id_dialog').val(),
                    message: $('.textarea-message').val()
                },
                dataType: 'json',
                success: function(return_message){

                    if(return_message.error_status == 'false'){

                        $('#block-dialog-messages').append('<div id="bmf' + return_message.id_message + '" class="block_message_from"></div>');

                        $('#bmf' + return_message.id_message).html('<div id="mf' + return_message.id_message + '" class="message_from"></div>');
                        $('#mf' + return_message.id_message).html('<div id="mfdf' + return_message.id_message + '" class="message_from dialog_from"></div>');

                        $('#mfdf' + return_message.id_message).html('<p>' + $('.textarea-message').val() + '</p>')

                        $('#bmf' + return_message.id_message).append('<div id="mtf' + return_message.id_message + '" class="message_time_from"></div>');
                        $('#mtf' + return_message.id_message).html(return_message.datetime_message + '&nbsp;');
                        $('#mtf' + return_message.id_message).append('<i class="glyphicon glyphicon-time"></i>');

                        $('.textarea-message').val('');

                        block.scrollTop = block.scrollHeight;

                        $('.textarea-message').focus();

                    }else{

                        alert(return_message.error_message);

                    }

                }

            });

        }

    });

});