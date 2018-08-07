$(document).ready(function(){

    $('.show-phone').click(function () {

        $.ajax({
            url: '../../api/adverts/show-phone',
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

});