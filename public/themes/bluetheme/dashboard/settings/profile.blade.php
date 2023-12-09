@extends(theme('dashboard.layout'))

@section('content')

    <!-- <div class="dashboard-inline-submenu-wrap mb-4 border-bottom">
        <a href="{{route('profile_settings')}}" class="active">{{__t('profile_settings')}}</a>
        <a href="{{route('profile_reset_password')}}" class="">{{__t('reset_password')}}</a>
    </div> -->


    <div class="profile-settings-wrap">

        <h4 class="mb-3">{{__t('profile_info')}}</h4>

        <form action="" method="post">
            @csrf

            @php
                $user = $auth_user;
                $countries = countries();
            @endphp

            <div class="profile-basic-info bg-white px-3">

                <div class="form-row">
                    <div class="form-group col-md-6 remove_error {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>{{__t('name')}} <span style="color:red;">*</span></label>
                        <input type="tel" class="form-control" name="name" value="{{$user->name}}" placeholder="{{__t('name')}}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('job_title') ? ' has-error' : '' }}">
                        <label>{{__t('job_title')}}</label>
                        <input type="text" class="form-control" name="job_title" value="{{$user->job_title}}" placeholder="{{__t('job_title')}}">
                        @if ($errors->has('job_title'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('job_title') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6 remove_error {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>{{__t('email')}} <span style="color:red;">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="{{__t('email')}}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label>{{__t('phone')}}</label>
                        <input type="text" class="form-control" name="phone" value="{{$user->phone}}" placeholder="{{__t('phone')}}">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>{{__t('address')}}</label>
                        <input type="text" class="form-control" name="address" value="{{$user->address}}" placeholder="{{__t('address')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{__t('address_2')}}</label>
                        <input type="text" class="form-control" name="address_2" value="{{$user->address_2}}" placeholder="{{__t('address_2')}}">
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{__t('city')}}</label>
                        <input type="text" class="form-control" name="city" value="{{$user->city}}" placeholder="{{__t('city')}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>{{__t('zip')}}</label>
                        <input type="text" class="form-control" name="zip_code" value="{{$user->zip_code}}" placeholder="{{__t('zip')}}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">{{__t('country')}}</label>

                        <select  class="form-control" name="country_id">
                            <option value="">Choose...</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{selected($user->country_id, $country->id)}} >{!! $country->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>{{__t('profile_photo')}}</label>
                        {!! image_upload_form('photo', $user->photo) !!}
                    </div>

                    <div class="form-group col-md-12">
                        <label>{{__t('about_me')}}</label>
                        <textarea class="form-control aboutme_incre" name="about_me" rows="10" placeholder="About Me" style="padding-top:12px;">{{$user->about_me}}</textarea>
                    </div>

                    

                </div>

            </div>


            <h4 class="my-4">{{__t('social_link')}} </h4>

             <div class="profile-basic-info bg-white px-3">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Website</label>
                        <input type="text" class="form-control" placeholder="Website" name="social[website]" value="{{$user->get_option('social.website')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Twitter</label>
                        <input type="text" class="form-control" placeholder="Twitter" name="social[twitter]" value="{{$user->get_option('social.twitter')}}" >
                    </div>
                    <div class="form-group col-md-4">
                        <label>Facebook</label>
                        <input type="text" class="form-control" placeholder="Facebook" name="social[facebook]" value="{{$user->get_option('social.facebook')}}" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Linkedin</label>
                        <input type="text" class="form-control" placeholder="Linkedin" name="social[linkedin]" value="{{$user->get_option('social.linkedin')}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Youtube</label>
                        <input type="text" class="form-control" placeholder="Youtube" name="social[youtube]" value="{{$user->get_option('social.youtube')}}" >
                    </div>
                    <div class="form-group col-md-4">
                        <label>Instagram</label>
                        <input type="text" class="form-control" placeholder="Instagram" name="social[instagram]" value="{{$user->get_option('social.instagram')}}" >
                    </div>
                </div>



                <button type="submit" class="btn btn-purple btn-lg"> {{__t('update_profile')}}</button>
            </div>
        </form>


    </div>


@endsection


@section('page-js')
    <script src="{{ asset('assets/js/filemanager.js') }}"></script>
@endsection
