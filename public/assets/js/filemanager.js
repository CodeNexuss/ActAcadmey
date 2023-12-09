
$(function() {
    "use strict";


    /**
     * @var pageData holding all of Json Format data at head section
     * including routes, home url etc
     */
/*

    $(document).on('click', 'a.thumbnail', function(e) {
        e.preventDefault();

        if ( $(this).closest('#modal-filemanager').hasClass('ckeditorBrowse') ){
            //Stop the script if request come from ckeditor image browse
            return;
        }

        var $target = $('[data-current-img="true"]');
        var img_src = $(this).find('img').attr('src');
        var img_id = $(this).parent().find('input').val();

        $target.find('a[data-toggle="filemanager"]').html('<img src="'+img_src+'" class="img-thumbnail" />');
        $target.find('.image-input').val(img_id);

        //$('#thumb-image').find('img').attr('src', $(this).find('img').attr('src'));
        //$('#input-image').val($(this).parent().find('input').val());

        $('#modal-filemanager').modal('hide');
    });
*/


    $(document).on('click', 'button.mediaInsertBtn', function(e) {
        e.preventDefault();

        if ( $(this).closest('#modal-filemanager').hasClass('ckeditorBrowse') ){
            //Stop the script if request come from ckeditor image browse
            return;
        }

        var $media = $('a.last-selected-media');
        var img_src = $media.find('img').attr('src');
        let valid_img_ext = [ 'jpg', 'jpeg', 'png', 'gif', 'webp', 'avif', 'jfif', 'pjpeg', 'pjp', 'apng', 'avif', 'svg', 'bmp', 'ico', 'cur', 'tif', 'tiff' ];

        if ($media.length){
            var media_info = JSON.parse($media.attr('data-media-info'));

            var $target = $('[data-current-img="true"]');

            if ($target.hasClass('media-btn-wrap')){
                $target.find('.saved-media-id').html("<p class='text-info'>#<strong>"+media_info.ID+"</strong></p>");
            } else if($target.find('a[data-toggle="filemanager"]').hasClass('image-only')) {
                let split = media_info.slug_ext.split('.');
                let ext = split[split.length - 1];
                
                if($.inArray(ext, valid_img_ext) === -1) {
                    $('#modal-filemanager').modal('hide');
                    $target.find('a[data-toggle="filemanager"]').parent().parent().find('.invalid-img-error').removeClass('hide');
                    return;
                } else {
                    $target.find('a[data-toggle="filemanager"]').parent().parent().find('.invalid-img-error').addClass('hide');
                    $target.find('a[data-toggle="filemanager"]').html('<img src="'+img_src+'" class="img-thumbnail" />');
                }
            }else{
                $target.find('a[data-toggle="filemanager"]').html('<img src="'+img_src+'" class="img-thumbnail" />');
            }

            $target.find('.image-input').val(media_info.ID);

            $('#modal-filemanager').modal('hide');
        }else{
            $('#statusMsg').html('<p class="alert alert-info mt-2">Please select a media</p>');
        }
    });

    $(document).on('click', '.filemanager-pagination-wrap a', function(e) {
        e.preventDefault();
        $('#modal-filemanager').load($(this).attr('href'));
    });

    $(document).on('click', '#button-refresh', function(e) {
        e.preventDefault();
        $('#modal-filemanager').load($(this).attr('href'));
    });

    $(document).on('keydown', 'input[name="filemanager-search"]', function(e) {
        if (e.which == 13) {
            $('#button-search').trigger('click');
        }
    });

    $(document).on('click', '#button-search', function(e) {
        var url = pageData.routes.load_filemanager;
        var filter_name = $('input[name="filemanager-search"]').val();
        if (filter_name) {
            url += '?filter_name=' + encodeURIComponent(filter_name);
        }
        $('#modal-filemanager').load(url);
    });


    $(document).on('click', '#button-upload', function() {
        $('#form-upload').remove();

        var $btn = $(this);

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="hidden" name="_token" value="'+pageData.csrf_token+'" /><input type="file" name="files[]" value="" multiple="multiple" /></form>');

        $("#form-upload input[name='files[]']").trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        var timer = setInterval(function() {
            if ($("#form-upload input[name='files[]']").val() != '') {
                clearInterval(timer);

                $.ajax({
                    url:  pageData.routes.post_media_upload,
                    type: 'post',
                    /*dataType: 'json',*/
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#button-upload i').replaceWith('<i class="la la-circle-o-notch fa-spin"></i>');
                        $('#button-upload').prop('disabled', true);
                    },
                    complete: function() {
                        $('#button-upload i').replaceWith('<i class="la la-upload"></i>');
                        $('#button-upload').prop('disabled', false);
                    },
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        //Download progress
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                percentComplete = Math.round(percentComplete);
                                $('#statusMsg').html('<div class="progress"> <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'+percentComplete+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%">'+percentComplete+'% Uploaded </div> </div>');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(json) {
                        if (json.success){
                            $('#statusMsg').html('<p class="alert alert-success">'+json.msg+'</p>');

                            if ($btn.attr('data-upload-success') === 'reload'){
                                window.location.reload();
                            }else{
                                $('#button-refresh').trigger('click');
                            }
                        }else {
                            $('#statusMsg').html('<p class="alert alert-danger">'+json.msg+'</p>');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('#statusMsg').html('<p class="alert alert-danger">'+thrownError+'</p>');
                    }
                });
            }
        }, 500);
    });

    /**
     * Media Delete From popup select modal
     */
    $(document).on('click', '#modal-filemanager #button-delete', function(e) {
        if (!confirm('Deleting all selected media. Are you sure?')) {
            return false;
        }
/*
        var media_ids = $('input[name^=\'media_ids\']:checked').map(function() {
            return $(this).val();
        }).get().join(",");
*/
        var media_ids = $('.media-modal-thumbnail.selected').map(function() {
            var media_info = JSON.parse($(this).attr('data-media-info'));
            return media_info.ID;
        }).get().join(",");

        $.ajax({
            url: pageData.routes.delete_media,
            type: 'POST',
            data: {media_ids : media_ids, _token : pageData.csrf_token},
            beforeSend: function() {
                $('#button-delete').prop('disabled', true);
            },
            complete: function() {
                $('#button-delete').prop('disabled', false);
            },
            success: function(json) {
                if (json.success){
                    $('#statusMsg').html('<p class="alert alert-success">'+json.msg+'</p>');
                    $('#button-refresh').trigger('click');
                }else {
                    $('#statusMsg').html('<p class="alert alert-danger">'+json.msg+'</p>');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#statusMsg').html('<p class="alert alert-danger">'+thrownError+'</p>');
            }
        });

    });

    /**
     * Media Delete From Info Modal
     */
    $(document).on('click', '#media-info-modal-trash-btn', function(e) {
        if (!confirm('Are you sure?')) {
            return false;
        }

        var $that = $(this);
        var media_id = $that.closest('#adminFileManagerModal').attr('data-media-id');
        $.ajax({
            url: pageData.routes.delete_media,
            type: 'POST',
            data: {media_ids : media_id, _token : pageData.csrf_token},
            beforeSend: function() {
                $('#adminFileManagerModal').modal('hide');
            },
            success: function(json) {
                if (json.success){
                    $('#media-grid-id-'+media_id).remove();
                }else {
                    $('#statusMsg').html('<p class="alert alert-danger">'+json.msg+'</p>');

                }
            },
        });
    });

    $(document).ready(function(){
        $(document).on('click', 'a[data-toggle="filemanager"]', function(e) {
            var $element = $(this);
            var $popover = $element.data('bs.popover'); // element has bs popover?
            $("body").addClass("minipop")
            e.preventDefault();

            $('.image-wrap').removeAttr('data-current-img');
            $element.closest('.image-wrap').attr('data-current-img', 'true');

            // destroy all image popovers
            $('a[data-toggle="filemanager"]').popover('dispose').addClass('my-super-popover');

            // remove flickering (do not re-add popover when clicking for removal)
            if ($popover) {
                return;
            }

            $element.popover({
                html: true,
                placement: 'right',
                trigger: 'manual',
                sanitize : false,
                content: function() {
                    return '<button type="button" id="button-image" class="btn btn-primary"><i class="la la-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="la la-trash-o"></i></button>';
                }
            });

            $element.popover('show');

            $('#button-image').on('click', function() {
                var $button = $(this);
                var $icon   = $button.find('> i');
                $('#modal-filemanager').remove();

                $.ajax({
                    url: pageData.routes.load_filemanager,
                    dataType: 'html',
                    beforeSend: function() {
                        $button.prop('disabled', true);
                        if ($icon.length) {
                            $icon.attr('class', 'la la-circle-o-notch la-spin');
                        }
                    },
                    complete: function() {
                        $button.prop('disabled', false);
                        if ($icon.length) {
                            $icon.attr('class', 'la la-pencil');
                        }
                    },
                    success: function(html) {
                        $('body').append('<div id="modal-filemanager" class="modal p-0" tabindex="-1">' + html + '</div>');
                        $('#modal-filemanager').modal('show');
                    }
                });

                $element.popover('dispose');
            });

            $(document).on('click','#button-clear', function() {
                //$element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

                if ( ! $element.closest('.image-wrap').hasClass('media-btn-wrap')){
                    $element.html('<img src="'+pageData.home_url+'/uploads/placeholder-image.png" alt="" class="img-thumbnail">');
                }

                $element.parent().find('input').val('');
                $element.popover('dispose');
            });

            $(document).on('click', '.file-manager-footer-pagination-wrap a', function(event) {
                event.preventDefault();
                var $button = $(this);
                let btn_txt = $button.text();

                // $('#modal-filemanager').remove();

                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    beforeSend: function() {
                        $button.prop('disabled', true);
                        $button.html('<i class="la la-circle-o-notch la-spin"></i>');
                    },
                    complete: function() {
                        $button.prop('disabled', false);
                        $button.html(btn_txt);
                    },
                    success: function(html) {
                        $('body').append('<div id="modal-filemanager" class="modal" tabindex="-1">' + html + '</div>');
                        $('#modal-filemanager').html(html);
                    }
                });
            });
        });
    });

    $(document).ready(function(){
        if( typeof(CKEDITOR) !== "undefined" ) {
            CKEDITOR.on('dialogDefinition', function (ev) {
                //dialogDefinition is a ckeditor event it's fired when ckeditor dialog instance is called
                var dialogName = ev.data.name;
                var dialogDefinition = ev.data.definition;
                if (dialogName === 'image') { //dialogName is name of dialog and identify which dialog is fired.
                    var infoTab = dialogDefinition.getContents('info'); // get tab of the dialog
                    var browse = infoTab.get('browse'); //get browse server button
                    browse.onClick = function () {
                        $('#modal-filemanager').remove();
                        $.ajax({
                            url: pageData.routes.load_filemanager,
                            dataType: 'html',
                            success: function (html) {
                                $('body').append('<div id="modal-filemanager" class="modal ckeditorBrowse" tabindex="-1">' + html + '</div>');
                                $('#modal-filemanager').modal('show');
                            }
                        });

                        /*
                        $(document).on('click', '.ckeditorBrowse a.thumbnail', function () {
                            var img_src = $(this).attr('data-image-size-original');
                            var img_alt = $(this).find('img').attr('alt');
                            var dialog = CKEDITOR.dialog.getCurrent();
                            dialog.setValueOf('info', 'txtUrl', img_src);
                            dialog.setValueOf('info', 'txtAlt', img_alt);
                            $('#modal-filemanager').modal('hide');
                        });
                        */

                        $(document).on('click', '.ckeditorBrowse button.mediaInsertBtn', function(e) {
                            e.preventDefault();

                            var $media = $('a.last-selected-media');
                            if ($media.length){
                                var media_info = JSON.parse($media.attr('data-media-info'));
                                var img_alt = media_info.alt_text ? media_info.alt_text : $(this).find('img').attr('alt');

                                var dialog = CKEDITOR.dialog.getCurrent();
                                dialog.setValueOf('info', 'txtUrl', media_info.url);
                                dialog.setValueOf('info', 'txtAlt', img_alt);

                                $('#modal-filemanager').modal('hide');
                            }else{
                                $('#statusMsg').html('<p class="alert alert-info mt-2">Please select a media</p>');
                            }
                        });

                    };

                }
            });
        }

    });


    /**
     * Media Modal for Insert
     */
    $(document).on('click', 'a.media-modal-thumbnail', function(e){
        e.preventDefault();
        var $that = $(this);
        $that.toggleClass('selected');
        $('a.media-modal-thumbnail').removeClass('last-selected-media');
        $that.addClass('last-selected-media');

        var info = JSON.parse($that.attr('data-media-info'));

        $('#mediaManagerPreviewScreen').attr('src', info.thumbnail);
        $('#sc_modal_info_media_id').val(info.ID);
        $('#mediaModalFileID').find('span').text(info.ID);
        $('#mediaModalFileName').find('span').text(info.slug_ext);
        $('#mediaModalFileType').find('span').text(info.mime_type);
        $('#mediaModalFileUploadedOn').find('span').text(info.uploaded_at);
        $('#mediaModalFileSize').find('span').text(info.size);

        //Form Value
        $('#mediaFileTitle').val(info.title);
        $('#mediaFileAltText').val(info.alt_text);
    });


    //media-modal-thumbnail


    /**
     * Admin Modal
     * @trigger sc-modal
     */
    $(document).on('click', '[data-toggle="sc-modal"]', function(e){
        e.preventDefault();

        var $that = $(this);
        var modalID = $that.attr('data-target');
        var info = JSON.parse($that.attr('data-media-info'));

        $('#mediaManagerPreviewScreen').attr('src', info.thumbnail);
        $('#sc_modal_info_media_id').val(info.ID);
        $('#mediaModalFileID').find('span').text(info.ID);
        $('#mediaModalFileName').find('span').text(info.slug_ext);
        $('#mediaModalFileType').find('span').text(info.mime_type);
        $('#mediaModalFileUploadedOn').find('span').text(info.uploaded_at);
        $('#mediaModalFileSize').find('span').text(info.size);

        //Form Value
        $('#mediaFileTitle').val(info.title);
        $('#mediaFileAltText').val(info.alt_text);

        $(modalID).attr('data-media-id', info.ID).modal('show')
    });

    $(document).on('change', 'form#adminMediaManagerModalForm', function(){
        var inputData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url : pageData.routes.media_update,
            data: inputData,
            beforeSend : function(){
                $('#formWorkingIconWrap').html('<i class="la la-spin la-spinner"></i>');
            },
            success: function(data){
                //
            },
            complete: function(){
                $('#formWorkingIconWrap').html('');
            }
        });
    });

});
