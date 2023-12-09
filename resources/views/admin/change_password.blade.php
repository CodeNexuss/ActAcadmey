@extends('layouts.admin')

@section('content')


    <form action="{{route('profile_reset_password')}}" method="post">
        @csrf

        <div class="profile-basic-info bg-white p-3">

            <div class="form-row">
                <div class="form-group col-md-12 {{form_error($errors, 'old_password')->class}}">
                    <label>{{__a('old_password')}} <span style="color:red;">*</span></label>
                    <input type="tel" class="form-control" name="old_password" placeholder="{{__a('old_password')}}">
                    {!! form_error($errors, 'old_password')->message !!}
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6 {{form_error($errors, 'new_password')->class}}">
                    <label>{{__a('new_password')}} <span style="color:red;">*</span></label>
                    <input type="tel" class="form-control" name="new_password" placeholder="{{__a('new_password')}}">
                    {!! form_error($errors, 'new_password')->message !!}
                </div>

                <div class="form-group col-md-6 {{form_error($errors, 'new_password_confirmation')->class}}">
                    <label>{{__a('new_password_confirmation')}} <span style="color:red;">*</span></label>
                    <input type="tel" class="form-control" name="new_password_confirmation" placeholder="{{__a('new_password_confirmation')}}">
                    {!! form_error($errors, 'new_password_confirmation')->message !!}
                </div>

            </div>


            <button type="submit" class="btn btn-info "> {{__a('update_profile')}}</button>


        </div>



    </form>




@endsection
