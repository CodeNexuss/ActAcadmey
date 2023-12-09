@component('mail::message')
# Hi {{$user->name}}

@component('mail::panel')
A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, please reset your password:
@endcomponent


@component('mail::button', ['url' => route('reset_password_link', $user->reset_token)])
Reset Password
@endcomponent

or

past below URL to your browser.

<p>{{route('forgot_password', $user->reset_token)}}</p>

Thanks,<br>
{{ get_option('site_name') }}

<p class="footer-social-icon-wrap" style="text-align:center;">
    <a href="{{ get_option('facebook_joinus_link') ?? '#' }}">  <img src="{{url('uploads/images/facebook.png?v='.time())}}" alt="facebook" width="20"></a>
    <a href="{{ get_option('twitter_joinus_link') ?? '#' }}" style="margin:0 5px;"><img src="{{url('uploads/images/twitter.png?v='.time())}}" alt="twitter" width="20"> </a>
    <a href="{{ get_option('youtube_joinus_link') ?? '#' }}"><img src="{{url('uploads/images/youtube.png?v='.time())}}" alt="youtube" width="20"> </a>
</p>

@endcomponent
