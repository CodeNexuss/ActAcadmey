@extends(theme('dashboard.layout'))

@section('content')

    <!-- <div class="dashboard-inline-submenu-wrap mb-4 border-bottom">
        <a href="{{route('profile_settings')}}" class="">{{__t('profile_settings')}}</a>
        <a href="{{route('profile_reset_password')}}" class="active">{{__t('reset_password')}}</a>
    </div> -->


    <div class="profile-settings-wrap">


        <form action="{{route('profile_reset_password')}}" method="post">
            @csrf

            <div class="profile-basic-info bg-white p-3">

                <div class="form-row">
                    <div class="form-group col-md-12 remove_error {{form_error($errors, 'old_password')->class}}">
                        <label>{{__t('old_password')}}</label>
                        <input type="tel" class="form-control" name="old_password" >
                        {!! form_error($errors, 'old_password')->message !!}
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 remove_error {{form_error($errors, 'new_password')->class}}">
                        <label>{{__t('new_password')}}</label>
                        <input type="tel" class="form-control" name="new_password" >
                        {!! form_error($errors, 'new_password')->message !!}
                    </div>

                    <div class="form-group col-md-6 remove_error {{form_error($errors, 'confirm_new_password')->class}}">
                        <label>{{__t('new_password_confirmation')}}</label>
                        <input type="tel" class="form-control" name="confirm_new_password" >
                        {!! form_error($errors, 'confirm_new_password')->message !!}
                    </div>

                </div>


                <button type="submit" class="btn btn-purple btn-lg"> {{__t('update_profile')}}</button>


            </div>



        </form>


    </div>


@endsection
