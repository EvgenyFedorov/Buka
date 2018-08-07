$(document).ready(function(){

    $('tr.car_diller_action').click(function(){

        $(this).removeClass('car_diller_action');
        $(this).addClass('success');

        //alert($('input#delete_cars').val());

        /*if($('input#delete_cars').val() == ""){

            $('input#delete_cars').value($(this).attr('id'));

        }else{

            $('input#delete_cars').append("," + $(this).attr('id'));

        }*/

    });

    $('tr.success').click(function(){

        $(this).removeClass('success');
        //alert($(this).attr('class'));

    });

});