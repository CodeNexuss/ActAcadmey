@extends('layouts.admin')

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')

    <form method="get" class="gap_input">


        @if($all_language)

            <div class="row">
                <div class="col-sm-12 warning-msg" style="display: none;">
                    <p class="alert alert-danger">Data add,edit & delete Operation are restricted in live</p>
                </div>
                <div class="col-sm-12">
                     <div class="cls_table table-responsive">
                        <table id="web_language_contents" class="table table-bordered">
                            <thead>
                                <tr>
                                @foreach($all_language as $language)
                                    <th>{{$language}}</th>
                                @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($lang_data['en'] as $main_key => $main_value) 
                                    @if(is_array($main_value))
                                    @foreach ($main_value as  $sub_key => $sub_value) 
                                        <tr>
                                        @foreach ($all_language as  $lan_key => $lang_value) 
                                            @if(isset($lang_data[$lan_key][$main_key][$sub_key]))
                                                <td data-lang="{{$lan_key}}" data-main_key="{{$main_key}}" class="cls_datarelative" data-sub_key="{{$sub_key}}">{{$lang_data[$lan_key][$main_key][$sub_key]}}</td>
                                            @else
                                                <td data-lang="{{$lan_key}}" data-main_key="{{$main_key}}" class="cls_datarelative" data-sub_key="{{$sub_key}}"> {{$lang_data['en'][$main_key][$sub_key]}}</td>
                                            @endif
                                        @endforeach
                                        </tr>
                                    @endforeach
                                    @endif
                                @endforeach    
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        @else
            {!! no_data() !!}
        @endif

    </form>
    

    <div class="modal cls_modal_lang fade" id="DescModal" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> -->
                    <h3 class="modal-title">@lang('admin.manage_language_file')</h3>
                </div>
                <div class="modal-body">

                    <div class="row dataTable">
                    <div class="col-md-4">
                    <label class="control-label" style="color: #333333" id="title_name">@lang('admin.content_change')</label>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" id="text-value" name="textValue"></textarea>
                        <span id="text-value-error" class="text text-danger error-message hide">This field is required</span>
                    </div>
                    </div>

                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id='modal_close_btn'  data-dismiss="modal" aria-hidden="true">@lang('admin.close')</button>
                    <button type="button" class="btn btn-primary" id='update_api_user_language'>@lang('admin.apply')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('page-js')
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var companyTable=  $('#web_language_contents').DataTable();   
            $('#web_language_contents').on('click', 'td', function () {
                var str = this;
                var get = str.innerText
                var name = $('td', this).eq().text();
                var lang = $(this).attr("data-lang");;
                var sub_key = $(this).attr("data-sub_key");
                var main_key =  $(this).attr("data-main_key");
                $('#text-value').attr('data-sub_key',sub_key);
                $('#text-value').attr('data-lang',lang);
                $('#text-value').attr('data-main_key',main_key);
                $("#text-value").val(get);
                $('#DescModal').modal("show");
            });
        });

        $('#text-value-error').hide();

        let env = "{{ is_live_env() ? 'live' : 'local' }}";

        $("#update_api_user_language").click(function(event){
            let element = $("#text-value");
            let language = $("#text-value").attr("data-lang");
            let sub_key  = $("#text-value").attr("data-sub_key");
            let main_key = $("#text-value").attr("data-main_key");
            let messages = $('#text-value').val();

            if(env=='live') {
                $('#modal_close_btn').trigger('click');
                $('.warning-msg').show();
                setTimeout(function() { $('.warning-msg').hide(); }, 3000);
                return;
            }
            if(messages.trim() != '') {
                $('#text-value-error').hide();

                $('#DescModal').modal("hide");
                var data = {}
                data['language']    = language
                data['main_key']    = main_key; 
                data['sub_key']     = sub_key; 
                data['messages']    = messages 
                data['file']        = '{{$file}}';
                console.log(data);
                $.ajax({
                    type: 'POST',
                    url: '{{route('update_language_text')}}',
                    data: { language, sub_key, main_key, messages, file: '{{$file}}', _token: pageData.csrf_token },
                    success: function(resp){
                        if (resp.success){
                            $('td[data-lang="' + data.language + '"][data-sub_key="' + data.sub_key + '"]').text(data.messages);
                            // window.location.reload(true);
                        }
                    },
                    error: function(err) {
                        alert('Something went wrong - ', err);
                    }
                });
            } else {
                event.preventDefault();
                $('#text-value-error').show();
            }            
        });

        $(document).on('click', '#modal_close_btn', function(event) {
            $('#text-value-error').hide();
        });
    </script>
@endsection