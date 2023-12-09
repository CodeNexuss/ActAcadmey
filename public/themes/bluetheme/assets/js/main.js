
$(function() {
    "use strict";

    if (jQuery().tooltip){
        $('[data-toggle="tooltip"]').tooltip();
    }
    if (jQuery().select2){
        $('select.select2').select2();
    }

    $(document).on('click', '.open_login_modal', function(e) {
        e.preventDefault();
        $('#loginFormModal').modal('show');
    });

    /**
     * Course Builder JS starts here
     */
    $(document).on('click', '.section-edit-btn', function(e) {
        e.preventDefault();
        $(this).closest('.dashboard-course-section').find('.section-edit-form-wrap').toggle();
    });

    $(document).on('submit', 'form.section-edit-form', function(e) {
        e.preventDefault();

        var $form = $(this);

        var $form_data = $form.serialize();
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $form.closest('.section-edit-form-wrap').hide();
            }
        });
    });
    $(document).on('onchange keyup paste', '.section-edit-form-wrap [name="section_name"]', function(e) {
        var text = $(this).val();
        $(this).closest('.dashboard-course-section').find('.dashboard-section-header .dashboard-section-name strong').text(text);
    });

    $(document).on('click', 'button.section-delete-btn', function(e) {
        e.preventDefault();

        if ( ! confirm("You are about to remove section and it's content. Are you sure you want to continue? ")){
            return;
        }

        var $that = $(this);
        var section_id = $that.attr('data-section-id');

        $.ajax({
            url : pageData.routes.delete_section,
            type : 'POST',
            data : {section_id : section_id, _token : pageData.csrf_token },
            beforeSend: function () {
                $that.closest('.dashboard-course-section').remove();
            }
        });
    });

    $(document).on('click', '.add-item-lecture', function(e) {
        e.preventDefault();

        var $that = $(this);
        $('.btn-cancel-form').trigger('click');

        var $formHtml = $('#section-lecture-form-html').html();
        $that.closest('.dashboard-course-section').find('.section-item-form-wrap').html($formHtml);

        $( 'textarea.ajaxCkeditor' ).ckeditor();
    });

    $(document).on('click', '.create-new-quiz', function(e) {
        e.preventDefault();

        var $that = $(this);
        $('.btn-cancel-form').trigger('click');

        var $formHtml = $('#section-quiz-form-html').html();
        $that.closest('.dashboard-course-section').find('.section-item-form-wrap').html($formHtml);

        $( 'textarea.ajaxCkeditor' ).ckeditor();
    });

    /**
     * Remove existing Form
     * Destroy CkEditor
     */

    $(document).on('click', '.btn-cancel-form', function(e) {
        e.preventDefault();

        var $previous_cke = $('#cke_description');
        if ($previous_cke.length) $previous_cke.remove();
        if (CKEDITOR.instances.description) CKEDITOR.instances.description.destroy();
        $(this).closest('.section-item-form-wrap').html('');
        $(this).closest('.section-item-edit-form-wrap').html('');
    });

    $(document).on('keyup', function(e){
        if (e.keyCode === 27){
            $('.btn-cancel-form').trigger('click');

            $('.modal-backdrop').remove();
            $(document.body).removeClass("modal-open");
        }
    });

    /**
     * Submit lecture form via Ajax
     * Add lecture
     */
    $(document).on('submit', 'form.curriculum-lecture-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $btn = $form.find('.btn-add-lecture');
        var $section = $form.closest('.dashboard-course-section');
        var section_id = parseInt($section.attr('id').match(/\d+/)[0], 10);

        var $form_data = $form.serialize()+'&section_id='+section_id;
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $('.lecture-request-response').html('');
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    $('.btn-cancel-form').trigger('click');
                    load_contents_open_item_form(section_id, response.item_id);
                }else{
                    $form.find('.lecture-request-response').html(response.error_msg);
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    /**
     * Load Section Items via Ajax
     * @param section_id
     */
    function load_contents(section_id){
        $.post(pageData.routes.load_contents, { section_id : section_id, _token : pageData.csrf_token }, function(response){
            $('#dashboard-section-'+section_id).find('.dashboard-section-body').html(response.html);
        });
    }

    function load_contents_open_item_form(section_id, item_id){
        $.post(pageData.routes.load_contents, { section_id : section_id, _token : pageData.csrf_token }, function(response){
            $('#dashboard-section-'+section_id).find('.dashboard-section-body').html(response.html);

            //Re-Open for Edit Lecture
            $('#section-item-'+item_id).find('button.section-item-edit-btn').trigger('click');
        });
    }

    $(document).on('click', '.section-item-edit-btn', function(e) {
        e.preventDefault();

        var $btn = $(this);
        var $edit_form_wrap = $btn.closest('.edit-curriculum-item').find('.section-item-edit-form-wrap');
        var item_id = parseInt($btn.attr('data-item-id'));

        $.ajax({
            url : pageData.routes.edit_item_form,
            type : 'POST',
            data : { item_id : item_id, _token : pageData.csrf_token },
            beforeSend: function () {
                $('.btn-cancel-form').trigger('click');

                $btn.addClass('loader').attr('disabled', 'disabled');
                $('.section-item-edit-form-wrap').html('');
            },
            success: function (response) {
                if (response.success){
                    $edit_form_wrap.html(response.form_html);
                    if ($edit_form_wrap.find('.ajaxCkeditor').length){
                        $( 'textarea.ajaxCkeditor' ).ckeditor();
                    }
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    $(document).on('click', '.section-item-delete-btn', function(e) {
        e.preventDefault();

        if ( ! confirm("You are about to remove a curriculum item. Are you sure you want to continue? ")){
            return;
        }

        var $btn = $(this);
        var item_id = parseInt($btn.attr('data-item-id'));

        $.ajax({
            url : pageData.routes.delete_item,
            type : 'POST',
            data : { item_id : item_id, _token : pageData.csrf_token },
            beforeSend: function () {
                $btn.closest('.edit-curriculum-item').remove();
            }
        });
    });

    $(document).on('onchange keyup paste', '.section-item-edit-form-wrap [name="title"]', function(e) {
        var text = $(this).val();
        $(this).closest('.edit-curriculum-item').find('.section-item-title-text').text(text);
    });

    $(document).on('submit', 'form.curriculum-edit-lecture-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $btn = $form.find('.btn-edit-lecture');
        var $section = $form.closest('.dashboard-course-section');
        var section_id = parseInt($section.attr('id').match(/\d+/)[0], 10);

        var $form_data = $form.serialize()+'&section_id='+section_id;
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    $('.btn-cancel-form').trigger('click');
                }else{
                    $form.find('.lecture-request-response').html(response.error_msg);
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    /**
     * Section item, lecture edit, tab
     *
     */
    $(document).on('click', '.curriculum-item-edit-tab a', function(e) {
        e.preventDefault();

        var $that = $(this);
        var id = $that.attr('data-tab');

        $('.list-tab-item').removeClass('active');
        $that.addClass('active');

        $('.section-item-tab-wrap').hide();
        $(id).show();
    });

    $(document).on('change', '.lecture_video_source', function(e){
        var $that = $(this);
        var selector = $(this).val();

        if (selector && selector !== '-1'){
            $('.video-source-input-wrap').show();
        }else{
            $('.video-source-input-wrap').hide();
        }
        $that.closest('.lecture-video-upload-wrap').find('.video-source-item').hide();
        $that.closest('.lecture-video-upload-wrap').find('.video_source_wrap_'+selector).show();
    });


    /**
     * Start Sorting Curriculum item
     */

    function dashboard_sections_items_sort() {
        if (jQuery().sortable) {
            $("#dashboard-curriculum-sections-wrap").sortable({
                handle: ".section-move-handler",
                start: function (e, ui) {
                    ui.placeholder.css('visibility', 'visible');
                },
                stop: function (e, ui) {
                    sorting_contents();
                },
            });
            $(".dashboard-section-body").sortable({
                connectWith: ".dashboard-section-body",
                handle: ".section-item-top",
                items: "div.edit-curriculum-item",
                start: function (e, ui) {
                    ui.placeholder.css('visibility', 'visible');
                },
                stop: function (e, ui) {
                    sorting_contents();
                },
            });
        }
    }
    dashboard_sections_items_sort();

    /**
     * Shorting Sections and It's item
     */
    function sorting_contents(){
        var sections = {};
        $('.dashboard-course-section').each(function(index, item){
            var $section = $(this);
            var topics_id = parseInt($section.attr('id').match(/\d+/)[0], 10);

            var items = {};
            $section.find('.edit-curriculum-item').each(function(lessonIndex, lessonItem){
                items[lessonIndex] = parseInt($(this).attr('id').match(/\d+/)[0], 10);
            });
            sections[index] = { 'section_id' : topics_id, 'item_ids' : items };
        });

        $.post(pageData.routes.curriculum_sort, { sections : sections, _token : pageData.csrf_token });
    }

    //END: Sorting

    /**
     * Attachments From curriculum
     */
    $(document).on('click', '#add_more_attachment_btn', function(e) {
        e.preventDefault();
        $('.attachment-upload-forms-wrap').append($('#upload-attachments-hidden-form').html());
    });

    $(document).on('click', '.btn-remove-lecture-attachment-form', function(e) {
        e.preventDefault();
        $(this).closest('.single-attachment-form').remove();
    });

    $(document).on('click', '.section-item-attachment-delete-btn', function(e) {
        e.preventDefault();
        var attachment_id = $(this).attr('data-attachment-id');
        $(this).closest('.dashboard-item-attachment').remove();
        $.post(pageData.routes.delete_attachment_item, { attachment_id : attachment_id, _token : pageData.csrf_token });
    });

    /**
     * Assignment
     */
    $(document).on('click', '.new-assignment-btn', function(e) {
        e.preventDefault();

        var $that = $(this);
        $('.btn-cancel-form').trigger('click');

        var $formHtml = $('#new-assignment-form-html').html();
        $that.closest('.dashboard-course-section').find('.section-item-form-wrap').html($formHtml);

        $( 'textarea.ajaxCkeditor' ).ckeditor();
    });

    /**
     * Create new Assignment
     */
    $(document).on('submit', 'form.new-assignment-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $btn = $form.find('.btn-add-assignment');
        var $section = $form.closest('.dashboard-course-section');
        var section_id = parseInt($section.attr('id').match(/\d+/)[0], 10);

        var $form_data = $form.serialize()+'&section_id='+section_id;
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $('.assignment-request-response').html('');
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    $('.btn-cancel-form').trigger('click');
                    load_contents(section_id);
                }else{
                    $form.find('.assignment-request-response').html(response.error_msg);
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    $(document).on('submit', 'form.update-assignment-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $btn = $form.find('.btn-save-assignment');

        var $form_data = $form.serialize();
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    $('.btn-cancel-form').trigger('click');
                }else{
                    $form.find('.assignment-request-response').html(response.error_msg);
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    $(document).on('change', '.course-price-type-wrap input[name="price_plan"]', function(e) {
        var $that = $(this);

        $('.course-pricing-wrap').hide();
        $('.price_plan_'+$that.val()).show();
    });

    $(document).on('change', '#course_category', function(e) {
        var $that = $(this);
        var $topic = $('#course_topic');

        $.ajax({
            url : pageData.routes.get_topic_options,
            type : 'POST',
            data : {category_id : $that.val(), _token : pageData.csrf_token},
            beforeSend: function () {
                $topic.closest('.form-group').find('.show-loader').addClass('loader');
            },
            success: function (response) {
                if (response.success){
                    $topic.html(response.options_html);

                    if (jQuery().select2){
                        $topic.select2("destroy").select2();
                    }
                }
            },
            complete: function () {
                $topic.closest('.form-group').find('.show-loader').removeClass('loader');
            }
        });
    });


    $(document).on('submit', '#instructor-search-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var input = $form.serialize();
        var url = $form.attr('action');
        var search_term = $form.find('[name="q"]').val();
        var term_length = search_term.trim().length;
        if (term_length < 4){
            $('#form-response-msg').html('<p class="text-info"> <i class="la la-info-circle"></i> Enter '+(4 - term_length)+' more characters to start search</p>');
            return false;
        }else{
            $('#form-response-msg').html('');
        }

        $.ajax({
            url : url,
            type : 'POST',
            data : input,
            beforeSend: function () {
                $('#instructor-search-results').html('');
                $form.find('button').addClass('loader');
            },
            success: function (response) {
                if (response.success){
                    $('#instructor-search-results').html(response.html);
                }
            },
            complete: function () {
                $form.find('button').removeClass('loader');
            }
        });
    });
    $(document).on('change keyup', '#instructor-search-form [name="q"]', function(e) {
        $('#instructor-search-results').html('');
    });

    $(document).on('click', '.instructor-remove-btn, .confirm-btn', function(e) {
        if ( ! confirm('Are you sure?')){
            return false;
        }
    });



    /** QUIZ JS **/

    $(document).on('change', '.option-type-selection-wrapper input[name="question_type"]', function(e) {
        e.preventDefault();

        var $that = $(this);

        if ($that.val() === 'radio' || $that.val() === 'checkbox'){
            $('#questionTypeFormModal').html($('#quizQuestionWrapType_radio').html());
        }else if ($that.val() === 'text' || $that.val() === 'textarea'){
            $('#questionTypeFormModal').html($('#quizQuestionWrapType_text').html());
        }
    });

    //Quiz Select question Type
    $(document).on('click','.list-group-item-info', function(){
        $(this).addClass("active").siblings().removeClass("active")
    });

    /**
     * Submit lecture form via Ajax
     * Add lecture
     */
    $(document).on('submit', 'form.curriculum-quiz-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $btn = $form.find('.btn-add-quiz');
        var $section = $form.closest('.dashboard-course-section');
        var section_id = parseInt($section.attr('id').match(/\d+/)[0], 10);

        var $form_data = $form.serialize()+'&section_id='+section_id;
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $('.quiz-request-response').html('');
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    $('.btn-cancel-form').trigger('click');
                    load_contents_open_item_form(section_id, response.item_id);
                }else{
                    $form.find('.quiz-request-response').html(response.error_msg);
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    $(document).on('submit', 'form.curriculum-edit-quiz-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $btn = $form.find('.btn-edit-quiz');
        var $section = $form.closest('.dashboard-course-section');
        var section_id = parseInt($section.attr('id').match(/\d+/)[0], 10);

        var $form_data = $form.serialize()+'&section_id='+section_id;
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    $('.btn-cancel-form').trigger('click');
                }else{
                    $form.find('.quiz-request-response').html(response.error_msg);
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    $(document).on('click', '#quiz-add-question-btn', function(e) {
        e.preventDefault();
        $('#quizQuestionTypeMoal').modal('show').css('overflow-y', 'auto');
    });
    $('body').on('hidden.bs.modal', function () {
        if($('.modal.in').length > 0) {
            $('body').addClass('modal-open');
        }
    });



    

    $(document).on('keyup change', '.question-opt input[type="text"]', function(e) {
        e.preventDefault();

        var $that = $(this);
        $that.closest('.question-opt').removeClass('newly');

        if ( ! $that.closest('.quiz-question-form-wrap').find('.newly').length){
            var $optHtml = $that.closest('.question-opt')[0].outerHTML;
            var index = $that.closest('.quiz-question-form-wrap').find('.question-opt').length;
            $that.closest('.question-opt').find('input').each(function(){
                var $input = $(this);
                $input.attr('name', $input.attr('name').replace('{index}', index));
            });
            $that.closest('.question-options-wrap').append($($optHtml).addClass('newly'));
        }
    });
    $(document).on('click', '.is_correct_input', function(e) {
        if ($(this).closest('form').find('#input_option_type_radio').prop('checked')){
            $('.is_correct_input').not(this).prop('checked', false);
        }
    });

    $(document).on('click', '.question-opt-trash', function(e) {
        e.preventDefault();

        var $that = $(this);
        var option_id = parseInt($that.attr('data-option-id'));

        if ($that.closest('.quiz-question-form-wrap').find('.question-opt').length > 1){
            $that.closest('.question-opt').remove();
        }
        if (option_id){
            $.post(pageData.routes.option_delete, { option_id : option_id, _token : pageData.csrf_token });
        }
    });

    /** Create Or Update Quiz Question **/
    $(document).on('submit', '#create-question-form, #edit-question-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var input = $form.serialize();
        var url = $form.attr('action');

        $.ajax({
            url : url,
            type : 'POST',
            data : input,
            beforeSend: function () {
                $form.find('button[type="submit"]').addClass('loader');
            },
            success: function (response) {
                if (response.success){
                    load_quiz_questions(response.quiz_id);
                    $('#quizQuestionTypeMoal, #editQuestionTypeModal').modal('hide')
                }else{
                    $form.find('#questionRequestResponse').html(response.error_msg);
                }
            },
            complete: function () {
                $form.find('button[type="submit"]').removeClass('loader');
            }
        });
    });

    function load_quiz_questions(quiz_id){
        $.post(pageData.routes.load_questions, { quiz_id : quiz_id, _token : pageData.csrf_token }, function(response){
            $('#quiz-questions-wrap').html(response.html);
        });
    }

    $(document).on('click', '.question-edit', function(e) {
        e.preventDefault();

        var $that = $(this);
        var question_id = $that.attr('data-question-id');

        $.ajax({
            url : pageData.routes.edit_question_form,
            type : 'POST',
            data : { question_id : question_id, _token : pageData.csrf_token },
            beforeSend: function () {
                $('#editQuestionTypeModal').remove();
                $that.find('.la').addClass('loader');
            },
            success: function (response) {
                if (response.success){
                    $('body').append(response.html);
                    sortable_options();
                    $('#editQuestionTypeModal').modal('show');
                }
            },
            complete: function () {
                $that.find('.la').removeClass('loader');
            }
        });
    });

    $(document).on('click', '.question-trash', function(e) {
        e.preventDefault();
        if ( ! confirm('Are you sure?')){
            return false;
        }

        var $that = $(this);
        var question_id = parseInt($that.attr('data-question-id'));
        $that.closest('.quiz-question-item').remove();
        $.post(pageData.routes.delete_question, { question_id : question_id, _token : pageData.csrf_token });
    });

    $(document).on('click', '#quiz-questions-tab-item', function(e) {
        sortable_questions();
    });

    function sortable_questions() {
        if (jQuery().sortable) {
            $("#quiz-questions-wrap").sortable({
                handle: ".question-sort",
                items: "div.quiz-question-item",
                start: function (e, ui) {
                    ui.placeholder.css('visibility', 'visible');
                },
                stop: function (e, ui) {
                    sorting_questions();
                },
            });
        }
    }

    function sorting_questions(){
        var questions = {};
        $('#quiz-questions-wrap .quiz-question-item').each(function(index, item){
            index++;
            questions[index] = parseInt($(this).attr('id').match(/\d+/)[0], 10);
        });
        $.post(pageData.routes.sort_questions, { questions : questions, _token : pageData.csrf_token });
    }

    function sortable_options() {
        if (jQuery().sortable) {
            $(".question-options-wrap").sortable({
                handle: ".question-option-sort",
                items: "div.question-opt",
                start: function (e, ui) {
                    ui.placeholder.css('visibility', 'visible');
                },
                stop: function (e, ui) {
                    //sorting_questions();
                },
            });
        }
    }

    /** END Quiz **/


    /**
     * Course Builder JS ends here
     */

    /** Dashboard JS **/
    $(document).on('click', '.withdraw-preference-method-name', function(e) {
        $('.withdraw-method-form').hide();
        $('#'+$(this).attr('data-target')).show();
    });

    /** END: Dashboard Js **/

    /**
     * Custom Toogle Menu For Top Nav
     */
    $(document).on('click', '.browse-categories-nav-link', function(e) {
        e.preventDefault();
        var $ul = $('.categories-ul-first');
        if ($ul.hasClass('d-block')){
            $ul.removeClass('d-block').addClass('d-none');
        }else{
            $ul.removeClass('d-none').addClass('d-block');
        }
    });
    $(document).on('click', '#miniCartDropDown', function(e) {
        e.preventDefault();
        var $ul = $('.mini-cart-body-wrap');
        if ($ul.hasClass('d-block')){
            $ul.removeClass('d-block').addClass('d-none');
        }else{
            $ul.removeClass('d-none').addClass('d-block');
        }
    });
    $(document).on('click', '.profile-dropdown-toogle', function(e) {
        e.preventDefault();
        var $ul = $('.profile-dropdown-menu');
        if ($ul.hasClass('d-block')){
            $ul.removeClass('d-block').addClass('d-none');
        }else{
            $ul.removeClass('d-none').addClass('d-block');
        }
    });
    /** END Custom Toggle Menu **/

    $(document).on('click', '.remove-cart-btn', function(e) {
        e.preventDefault();

        var $btn = $(this);
        var course_id = $btn.attr('data-course-id');
        var cart_id = $btn.attr('data-cart-id');
        $btn.closest('.mini-cart-course-item').remove();
        $.post(pageData.routes.remove_cart, {cart_id : cart_id, _token : pageData.csrf_token}, function(response){
            if (response.success){
                $('.dropdown.mini-cart-item').html(response.cart_html);

                var html = '<i class="la la-shopping-cart"></i>' + $('.add-to-cart-btn-'+course_id).attr('data-addcart-msg');
                $('.add-to-cart-btn-'+course_id).prop('disabled', false);
                $('.add-to-cart-btn-'+course_id).html(html);
            }
        });
    });

    $(document).on('click', 'a.nav-icon-list', function(e) {
        e.preventDefault();
        $('.lecture-sidebar').toggle();
    });

    /**
     * Progress bar Circle
     */
    $(".progress.circle").each(function() {
        var value = $(this).attr('data-value');
        var left = $(this).find('.progress-left .progress-bar');
        var right = $(this).find('.progress-right .progress-bar');

        if (value > 0) {
            if (value <= 50) {
                right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
            } else {
                right.css('transform', 'rotate(180deg)')
                left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
            }
        }
    });
    function percentageToDegrees(percentage) {
        return percentage / 100 * 360
    }
    /**
     * END Progress bar
     */


    /**
     * Characters limits
     */
    $(document).on('keyup change', '[data-maxlength]', function(e) {
        e.preventDefault();
        var $that = $(this);
        var length = parseInt($that.attr('data-maxlength'));
        var value = $that.val();
        var remaining_length = length - value.length;
        if (remaining_length < 1){
            remaining_length = 0;
        }
        $that.closest('.form-group').find('.input-group-text').html(remaining_length);

        if (value.length  > length){
            $that.val(value.substr(0, length));
        }
    });

    function collapse_if_much_height() {
        var $contentExpandInner = $('.content-expand-inner');
        if ($contentExpandInner.length) {
            $contentExpandInner.each(function (index, item) {
                var $that = $(this);
                var height = $that.height();
                if (height > 270) {
                    $(this).closest('.content-expand-wrap').append('<span class="expand-more-btn-wrap"><button type="button" class="expand-more-btn btn-sm btn btn-link"> + See More</button></span>');
                }
            });
        }
        $(document).on('click', '.expand-more-btn', function (e) {
            e.preventDefault();
            var $that = $(this);

            $that.closest('.content-expand-wrap').css("max-height", "none");
            $that.closest('.expand-more-btn-wrap').remove();
        });
    }
    collapse_if_much_height();


    /**
     * Expand Collapse Section
     */
    $(document).on('click', '.course-section-header', function (e) {
        var $that = $(this);

        var display = $that.next('.course-section-body').css("display").trim();
        if (display === 'none'){
            $that.find('i.la').removeClass('la-plus').addClass('la-minus');
        }else{
            $that.find('i.la').removeClass('la-minus').addClass('la-plus');
        }
        $that.next('.course-section-body').slideToggle();
    });

    $(document).on('click', '#expand-collapse-all-sections a', function (e) {
        var $that = $(this);
        $that.hide();

        var action = $that.attr('data-action');
        if (action === 'expand'){
            $('a[data-action="collapse"]').show();
            $('.course-section-name i.la').removeClass('la-plus').addClass('la-minus');
            $('.course-section .course-section-body').slideDown();
        }else{
            $('a[data-action="expand"]').show();
            $('.course-section-name i.la').removeClass('la-minus').addClass('la-plus');
            $('.course-section .course-section-body').slideUp();
        }
    });
    //END Collapse Section


    /**
     * Add To Cart
     */

    //add-to-cart-btn

    $(document).on('click', '.add-to-cart-btn', function (e) {
        var $btn = $(this);
        var course_id = $btn.attr('data-course-id');

        if ( ! pageData.is_logged_in){
            //$('#loginFormModal').modal('show');
            //return;
        }
        let elem = $('.add-to-cart-btn-'+course_id);

        $.ajax({
            url : pageData.routes.add_to_cart,
            type : 'POST',
            data : {course_id : course_id, _token : pageData.csrf_token},
            beforeSend: function () {
                // $btn.addClass('loader').attr('disabled', 'disabled');
                elem.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    $('.dropdown.mini-cart-item').html(response.cart_html);
                    elem.html("<i class='la la-check-circle'></i> "+$btn.attr('data-incart-msg'));
                    // $btn.html("<i class='la la-check-circle'></i> "+$btn.attr('data-incart-msg'));
                }else{
                    elem.removeClass('loader').removeAttr('disabled');
                    // $btn.removeClass('loader').removeAttr('disabled');
                }
            },
            error : function(jqXHR, textStatus, errorThrown){
                elem.removeClass('loader').removeAttr('disabled');
                // $btn.removeClass('loader').removeAttr('disabled');
            },
            complete: function () {
                elem.removeClass('loader');
                // $btn.removeClass('loader');
            }
        });

    });

    if ($('#loginFormModalShouldOpen').length){
        $('#loginFormModalShouldOpen').modal('show');
    }

    /**
     * Checkout page
     */
    $('.checkout-payment-methods-wrap .tab-pane:first-child').addClass('show active');

    /**
     * Rating set
     */
    $(document).on('mouseenter', '.review-write-star-wrap i', function(){
        $(this).closest('.review-write-star-wrap').find('i').removeClass('la-star').addClass('la-star-o');
        var ratingValue = $(this).attr('data-rating-value');

        for (var i = 1; i<= ratingValue; i++){
            $(this).closest('.review-write-star-wrap').find('i[data-rating-value="'+i+'"]').removeClass('la-star-o').addClass('la-star');
        }
        $(this).closest('.review-write-star-wrap').find('input[name="rating_value"]').val(ratingValue);
    });

    /**
     * Add to WishList
     */
    $(document).on('click', '.course-card-add-wish', function(){
        if ( ! pageData.is_logged_in){
            $('#loginFormModal').modal('show');
            return false;
        }
        var $btn = $(this);
        var course_id = $btn.attr('data-course-id');

        $.ajax({
            url : pageData.routes.update_wish_list,
            type : 'POST',
            data : {course_id : course_id, _token : pageData.csrf_token},
            beforeSend: function () {
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    if (response.state === 'added'){
                        $btn.find('i').removeClass('la-heart-o').addClass('la-heart');
                    }else{
                        $btn.find('i').removeClass('la-heart').addClass('la-heart-o');
                    }

                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');;
            }
        });
    });

    $(document).on('click', '.course-card-update-wish', function(){
        if ( ! pageData.is_logged_in){
            $('#loginFormModal').modal('show');
            return false;
        }
        var $btn = $(this);
        var course_id = $btn.attr('data-course-id');

        $.ajax({
            url : pageData.routes.update_wish_list,
            type : 'POST',
            data : {course_id : course_id, _token : pageData.csrf_token},
            beforeSend: function () {
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                let elem = $('.course-card-update-wish-'+course_id);
                if (response.success){
                    if (response.state === 'added'){
                        elem.find('i').removeClass('la-heart-o').addClass('la-heart');
                    }else{
                        if($btn.data('page')==='wishlist') {
                            elem.closest('.cls_alllistWidth').remove();
                            $btn.closest('.popover').remove();
                        }
                        elem.find('i').removeClass('la-heart').addClass('la-heart-o');
                    }

                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');;
            }
        });
    });

    $(document).on('change', '#course-filter-form', function() {
        $(this).submit();
    });

    /** Start Quiz **/
    $(document).on('click', '#btn-start-quiz', function() {
        var $btn = $(this);
        var quiz_id= $btn.attr('data-quiz-id');

        $.ajax({
            url : pageData.routes.start_quiz,
            type : 'POST',
            data : {quiz_id : quiz_id, _token : pageData.csrf_token },
            beforeSend: function () {
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    location.href = response.quiz_url
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');;
            }
        });
    });


    $(document).on('submit', 'form.quiz-question-submit', function(e) {
        e.preventDefault();

        var $form = $(this);
        var url = $form.attr('action');
        var $form_data = $form.serialize();
        var $btn = $form.find('button[type="submit"]');

        var qvalidation = question_validation();
        if ( ! qvalidation){
            $('#questionRequiredAlertModal').modal('show');
            return qvalidation;
        }

        $.ajax({
            url : url,
            type : 'POST',
            data : $form_data,
            beforeSend: function () {
                $btn.addClass('loader').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success){
                    location.href = response.quiz_url
                }
            },
            complete: function () {
                $btn.removeClass('loader').removeAttr('disabled');
            }
        });
    });

    function question_validation() {
        var validated = true;

        var $raWrap = $('.question-single-wrap');
        var $inputs = $raWrap.find('input');
        if ($inputs.length) {
            var $type = $inputs.attr('type');
            if ($type === 'radio') {
                if ($raWrap.find('input[type="radio"]:checked').length == 0) {
                    validated = false;
                }
            } else if ($type === 'checkbox') {
                if ($raWrap.find('input[type="checkbox"]:checked').length == 0) {
                    validated = false;
                }
            } else if ($type === 'text') {
                if ( ! $inputs.val().trim().length) {
                    validated = false;
                }
            }
        }
        if ($raWrap.find('textarea').length) {
            if ($raWrap.find('textarea').val().trim().length < 1) {
                validated = false;
            }
        }

        return validated;
    }


    /**
     * Cookie Remove
     */
    if ( ! getCookie('cookie_notice')) {
        if (pageData.cookie_html.length > 0) {
            $('body').append(pageData.cookie_html);
        }
    }
    $('.cookie-dismiss').click(function(e){
        e.preventDefault();
        setCookie('cookie_notice', 'exists', 30);
        $(this).closest('.cookie_notice_popup').remove();
    });
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    $(document).on('click', '.cls_close', function (e) {
        $(".lecture-sidebar").css("transform","translateX(1000%)")
        $(".lecture-container").css("margin-right","0")
    })
     $(document).on('click', '.cls_leftpanel', function (e) {
        if ( $(window).width() > 800 ) {
            $(".lecture-sidebar").css("transform","translateX(0)")
            $(".lecture-container").css("margin-right","350px")
        }
        else {
               e.preventDefault();
            $('.lecture-sidebar').toggle();
            $(".lecture-sidebar").css("transform","translateX(0)")
            $(".lecture-container").css("margin-right","0px")
        }
    })
    $(document).ready(function(){
        if($(window).width() < 992){
            $(document).on('click', '.open_cate', function (e) {
                $(".categories-menu").addClass('cate');
            })
            $(".test").click(function(){
                $(".first_level").addClass("open_sub_cate")
            })
            $(".topic").click(function(){
                $(".second_level").addClass("open_topics")
            })
            $(".close_cate").click(function(){
                $(".categories-menu").removeClass("cate").addClass("ani");
                $(".categories-ul-first").css({"display" : "none"})
            });
            $(".test .back_first_animate").click(function(event){
                $(".first_level").removeClass("open_sub_cate").addClass("ani");
                event.stopPropagation();
            })
            $(".topic .back_second_animate").click(function(event){
                $(".second_level").removeClass("open_topics").addClass("ani");
                event.stopPropagation();
            })
        }
    });
    
});

//Profile edit popup Search field scroll prevent
$(window).on("resize", function (){
    //For Mobile view 
    if($(window).width() <= 576){
        $(document).on('click touchstart','.stop_scroll, .title_scroll, .alt_scroll',function(){
            $(".modal").addClass("body_stop")
        })
        $(document).on('mouseleave touchend','.modal-content',function(){
            $(".modal").removeClass("body_stop")
        })
    }
  }).resize();
