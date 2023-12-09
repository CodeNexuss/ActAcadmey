
<div class="dashboard-wrap">
    <div class="col-lg-12 mb-3">
            <div class="container">
                <div class="dashboard-menu-col">
                    <ul class="dashboard-menu">

                        <li class="{{request()->is('dashboard') ? 'active' : ''}}"><a href="{{route('dashboard')}}"> <i class="la la-dashboard"></i> Dashboard </a></li>

                        @if($auth_user->isInstructor())
                            <li class="{{request()->is('dashboard/courses/*') ? 'active' : ''}}">
                                <a href="{{route('create_course')}}"> <i class="la la-chalkboard-teacher"></i> Create new Course </a>
                            </li>
                            <li class="{{request()->is('dashboard/my-courses*') ? 'active' : ''}}">
                                <a href="{{route('my_courses')}}"> <i class="la la-graduation-cap"></i> {{__t('my_courses')}} </a>
                            </li>

                            <li><a href="#"> <i class="la la-comment-dollar"></i> Earnings </a></li>
                            <li><a href="#"> <i class="la la-wallet"></i> Withdrawal </a></li>
                            <li><a href="#"> <i class="la la-question"></i> Students Quiz Attempts </a></li>
                            <li class="border-top"></li>
                        @endif

                        <li><a href="#"> <i class="la la-user-cog"></i> My Profile </a></li>
                        <li><a href="#"> <i class="la la-pencil-square-o"></i> Enrolled Courses </a></li>
                        <li><a href="#"> <i class="la la-heart-o"></i> Wishlist </a></li>
                        <li><a href="#"> <i class="la la-star-half-alt"></i> Reviews </a></li>
                        <li><a href="#"> <i class="la la-question-circle-o"></i> My Quiz Attempts </a></li>
                        <li><a href="#"> <i class="la la-history"></i> Purchase History </a></li>
                        <li><a href="#"> <i class="la la-clipboard-list"></i> Assignments </a></li>
                        <li><a href="#"> <i class="la la-tools"></i> Settings </a></li>
                    </ul>
                </div>
            </div>
        </div>
    <div class="container py-4">
        <div class="row">
            

            <div class="col-lg-12">
                <div class="cls_right">
                    @include(theme($view))
                </div>
            </div>

        </div>
    </div>

</div>
