$(document).ready(function(){

    $('#preloader').hide();

    $('#btn-uploaded-photo').click(function () {

        $('#file').click();

    });

    $('#file').bind('change', function(){
        var data = new FormData();
        var error = '';
        jQuery.each($('#file')[0].files, function(i, file) {

            if(file.name.length < 1) {
                error = error + ' Файл имеет неправильный размер! ';
            } //Проверка на длину имени
            if(file.size > 1000000) {
                error = error + ' File ' + file.name + ' is to big.';
            } //Проверка размера файла
            if(file.type != 'image/png' && file.type != 'image/jpg' && !file.type != 'image/gif' && file.type != 'image/jpeg' ) {
                error = error + 'File  ' + file.name + '  doesnt match png, jpg or gif';
            } //Проверка типа файлов
            data.append('file-'+i, file);
        });

        data.append('_token', $('#_token').val());

        if (error != '') {$('#info').html(error);} else {

            $.ajax({
                url: '../../api/user/loadimages/uploadfile',
                data: data,
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){ // проверка что осуществляется upload
                        myXhr.upload.addEventListener('progress',progressHandlingFunction, false); //передача в функцию значений
                    }
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $('#preloader').show();
                },
                success: function(return_uploaded){

                    if(return_uploaded.error_status == 'false'){

                        $('#btn-uploaded-setting-advert-img').hide();

                        var this_result = return_uploaded.uploaded_photo;

                        for (var p in return_uploaded.uploaded_photo) {

                            //alert(return_uploaded['uploaded_photo'][p] + '/' + return_uploaded['uploaded_photo_id'][p]);

                            $('#block-upload-result').append('<div id="block-img' + return_uploaded['uploaded_photo_id'][p] + '"></div>');

                            $('#block-img' + return_uploaded['uploaded_photo_id'][p])
                                .css('border', '1px solid #f1f1f1')
                                .css('display', 'inline-block')
                                .css('width', '45%')
                                .css('margin-right', '10px')
                                .css('margin-bottom', '10px');

                             $('#block-img' + return_uploaded['uploaded_photo_id'][p]).html('<a id="cui_' + return_uploaded['uploaded_photo_id'][p] + '">×</a>');
                             $('#cui_' + return_uploaded['uploaded_photo_id'][p] )
                             .attr('href', '#')
                             .attr('data-dismiss', 'alert')
                             .attr('aria-label', 'close')
                             .attr('title', 'Удалить')
                             .attr('name', return_uploaded['uploaded_photo_id'][p])
                             .css('font-size', '25px')
                             .addClass('close delete-uploaded-img');

                             $('#block-img' + return_uploaded['uploaded_photo_id'][p]).append('<img id="img' + return_uploaded['uploaded_photo_id'][p] + '">');
                             $('#img' + return_uploaded['uploaded_photo_id'][p])
                                 .attr('src', return_uploaded['uploaded_photo'][p])
                                 .css('width', '100%');

                             $('#block-upload-result').show();
                             $('.show-block-btn-upload-file').hide();

                             $('#file-upload-advert').val($('#file-upload-advert').val() + '[' + return_uploaded['uploaded_photo'][p] + '],');

                        }

                        $('.delete-uploaded-img').click(function () {

                            $('#btn-uploaded-setting-advert-img').show();
                            deleteFileImg($(this).attr('name'));
                            removeValueImg($(this).attr('name'));

                        });

                    }else{

                        alert(return_uploaded.error_message);

                    }

                },
                error: errorHandler = function() {
                    $('#info').html('Ошибка загрузки файлов');
                }
            });
        }
    });

    function deleteFileImg(idi) {

        $.ajax({
            url: '../../api/user/loadimages/deletefile',
            type: "POST",
            data: {
                _token: $('#_token').val(),
                id_img: idi,
                id_advert: $('#id_advert').val(),
                del_img: $('#img' + idi).attr('src'),
                load_img: $('#file-upload-advert').val()
            },
            dataType: 'json',
            success: function(return_delete_img){

                if(return_delete_img.error_status == 'false'){

                    $('#block-img' + idi).remove();

                }else{

                    alert(return_delete_img.error_message);

                }

            }

        });

    }

    function removeValueImg(idi) {

        var replacement = '[' + $('#img' + idi).attr('src') + '],';
        var text = $('#file-upload-advert').val();
        $('#file-upload-advert').val(text.replace(replacement, ''));

        if($('#file-upload-advert').val() == ""){

            $('#block-upload-result').hide();
            $('.show-block-btn-upload-file').show();

        }

    }

    function progressHandlingFunction(e){
        if(e.lengthComputable){
            $('progress').attr({value:e.loaded,max:e.total});
        }
    }

    $('.delete-uploaded-img-start').click(function () {

        $('#btn-uploaded-setting-advert-img').show();
        deleteFileImg($(this).attr('name'));
        removeValueImg($(this).attr('name'));

    })

});