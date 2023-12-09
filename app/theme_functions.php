<?php

function dashboard_menu(){
    $menu = [];

    //$menu['route_name'] = 'value';


    $user = \Illuminate\Support\Facades\Auth::user();

    if ($user->isInstructor()) {

        $pendingDiscusionBadge = '';
        $pendingDiscussionCount = $user->instructor_discussions->where('replied', 0)->count();
        if ($pendingDiscussionCount){
            $pendingDiscusionBadge = "<span class='badge badge-warning float-right'> {$pendingDiscussionCount} </span>";
        }

        $menu = apply_filters('dashboard_menu_for_instructor', [
            'enrolled_courses' => [
                'name' => __t('enrolled_courses'),
                'icon' => '<i class="la la-pencil-square-o"></i>',
                'is_active' => request()->is('dashboard/enrolled-courses*') || request()->is('dashboard/wishlist*') || request()->is('dashboard/my-quiz-attempts*'),
            ],
            'my_courses' => [
                'name' => __t('my_courses'),
                'icon' => '<i class="la la-pencil-square-o"></i>',
                'is_active' => request()->is('dashboard/my-courses') || request()->is('dashboard/courses*') || request()->is('dashboard/assignments*') || request()->is('dashboard/discussions*') || request()->is('dashboard/students-progress*'),
            ],
            'reviews_i_wrote' => [
                'name' => __t('reviews'),
                'icon' => '<i class="la la-star-half-alt"></i>',
                'is_active' => request()->is('dashboard/reviews-i-wrote*') || request()->is('dashboard/my-courses-reviews*'),
            ],
            'earning' => [
                'name' => __t('earnings'),
                'icon' => '<i class="la la-comment-dollar"></i>',
                'is_active' => request()->is('dashboard/earning*') || request()->is('dashboard/withdraw*')
            ],
            'purchase_history' => [
                'name' => __t('account'),
                'icon' => '<i class="la la-history"></i>',
                'is_active' => request()->is('dashboard/settings*') || request()->is('dashboard/purchases*'),
            ],


            // 'create_course' => [
            //     'name' => __t('create_new_course'),
            //     'icon' => '<i class="la la-chalkboard-teacher"></i>',
            //     'is_active' => request()->is('dashboard/courses/new'),
            // ],
            // 'my_courses' => [
            //     'name' => __t('my_courses'),
            //     'icon' => '<i class="la la-graduation-cap"></i>',
            //     'is_active' => request()->is('dashboard/my-courses'),
            // ],
            // 'earning' => [
            //     'name' => __t('earnings'),
            //     'icon' => '<i class="la la-comment-dollar"></i>',
            //     'is_active' => request()->is('dashboard/earning*')
            // ],
            // 'withdraw' => [
            //     'name' => __t('withdraw'),
            //     'icon' => '<i class="la la-wallet"></i>',
            //     'is_active' => request()->is('dashboard/withdraw*'),
            // ],
            // 'my_courses_reviews' => [
            //     'name' => __t('my_courses_reviews'),
            //     'icon' => '<i class="la la-star"></i>',
            //     'is_active' => request()->is('dashboard/my-courses-reviews*'),
            // ],
            // 'courses_has_quiz' => [
            //     'name' => __t('quiz_attempts'),
            //     'icon' => '<i class="la la-check-double"></i>',
            //     'is_active' => request()->is('dashboard/courses-has-quiz*'),
            // ],
            // 'courses_has_assignments' => [
            //     'name' => __t('assignments'),
            //     'icon' => '<i class="la la-star"></i>',
            //     'is_active' => request()->is('dashboard/assignments*'),
            // ],
            // 'instructor_discussions' => [
            //     'name' => __t('discussions') . $pendingDiscusionBadge,
            //     'icon' => '<i class="la la-question-circle-o"></i>',
            //     'is_active' => request()->is('dashboard/discussions*'),
            // ]
        ]);

        // $menu = $menu + apply_filters('dashboard_menu_for_users', [
        //     'enrolled_courses' => [
        //         'name' => __t('enrolled_courses'),
        //         'icon' => '<i class="la la-pencil-square-o"></i>',
        //         'is_active' => request()->is('dashboard/enrolled-courses*'),
        //     ],
        //     'wishlist' => [
        //         'name' => __t('wishlist'),
        //         'icon' => '<i class="la la-heart-o"></i>',
        //         'is_active' => request()->is('dashboard/wishlist*'),
        //     ],
        //     'reviews_i_wrote' => [
        //         'name' => __t('reviews'),
        //         'icon' => '<i class="la la-star-half-alt"></i>',
        //         'is_active' => request()->is('dashboard/reviews-i-wrote*'),
        //     ],
        //     'my_quiz_attempts' => [
        //         'name' => __t('my_quiz_attempts'),
        //         'icon' => '<i class="la la-question-circle-o"></i>',
        //         'is_active' => request()->is('dashboard/my-quiz-attempts*'),
        //     ],
        //     'purchase_history' => [
        //         'name' => __t('purchase_history'),
        //         'icon' => '<i class="la la-history"></i>',
        //         'is_active' => request()->is('dashboard/purchases*'),
        //     ],
        //     'profile_settings' => [
        //         'name' => __t('settings'),
        //         'icon' => '<i class="la la-tools"></i>',
        //         'is_active' => request()->is('dashboard/settings*'),
        //     ],
        // ]);

    } else if($user->isStudent()) {
        $menu = apply_filters('dashboard_menu_for_users', [
            'enrolled_courses' => [
                'name' => __t('enrolled_courses'),
                'icon' => '<i class="la la-pencil-square-o"></i>',
                'is_active' => request()->is('dashboard/enrolled-courses*') || request()->is('dashboard/wishlist*') || request()->is('dashboard/my-quiz-attempts*'),
            ],
            'reviews_i_wrote' => [
                'name' => __t('reviews'),
                'icon' => '<i class="la la-star-half-alt"></i>',
                'is_active' => request()->is('dashboard/reviews-i-wrote*'),
            ],
            'purchase_history' => [
                'name' => __t('account'),
                'icon' => '<i class="la la-history"></i>',
                'is_active' => request()->is('dashboard/settings*') || request()->is('dashboard/purchases*'),
            ],
        ]);
    }


    // if ($user->is_admin){
    //     $menu['admin'] = [
    //         'name' => __t('go_to_admin'),
    //         'icon' => '<i class="la la-cogs"></i>',
    //     ];
    // }

    return apply_filters('dashboard_menu_items', $menu);
}

function dashboard_submenu(){
    $menu = [];

    $user = \Illuminate\Support\Facades\Auth::user();

    if ($user->isInstructor()) {

        $pendingDiscusionBadge = '';
        $pendingDiscussionCount = $user->instructor_discussions->where('replied', 0)->count();
        if ($pendingDiscussionCount){
            $pendingDiscusionBadge = "<span class='badge badge-warning float-right'> {$pendingDiscussionCount} </span>";
        }

        if(request()->is('dashboard/enrolled-courses*') || request()->is('dashboard/wishlist*') || request()->is('dashboard/my-quiz-attempts*')) {
            $menu_array = [
                'enrolled_courses' => [
                    'name' => __t('enrolled_courses'),
                    'icon' => '<i class="la la-pencil-square-o"></i>',
                    'url' => route('enrolled_courses'),
                    'is_active' => request()->is('dashboard/enrolled-courses*'),
                ],
                'wishlist' => [
                    'name' => __t('wishlist'),
                    'icon' => '<i class="la la-heart-o"></i>',
                    'url' => route('wishlist'),
                    'is_active' => request()->is('dashboard/wishlist*'),
                ],
                'my_quiz_attempts' => [
                    'name' => __t('my_quiz_attempts'),
                    'icon' => '<i class="la la-question-circle-o"></i>',
                    'url' => route('my_quiz_attempts'),
                    'is_active' => request()->is('dashboard/my-quiz-attempts*'),
                ],
            ];
        } else if(request()->is('dashboard/my-courses') || request()->is('dashboard/courses*') || request()->is('dashboard/courses-has-quiz*') || request()->is('dashboard/assignments*') || request()->is('dashboard/discussions*') || request()->is('dashboard/students-progress*')) {
            $menu_array = [
                'my_courses' => [
                    'name' => __t('my_courses'),
                    'icon' => '<i class="la la-graduation-cap"></i>',
                    'url' => route('my_courses'),
                    'is_active' => request()->is('dashboard/my-courses'),
                ],
                'create_course' => [
                    'name' => __t('create_new_course'),
                    'icon' => '<i class="la la-chalkboard-teacher"></i>',
                    'url' => route('create_course'),
                    'is_active' => request()->is('dashboard/courses/new'),
                ],
                'courses_has_quiz' => [
                    'name' => __t('quiz_attempts'),
                    'icon' => '<i class="la la-check-double"></i>',
                    'url' => route('courses_has_quiz'),
                    'is_active' => request()->is('dashboard/courses-has-quiz*'),
                ],
                'courses_has_assignments' => [
                    'name' => __t('assignments'),
                    'icon' => '<i class="la la-star"></i>',
                    'url' => route('courses_has_assignments'),
                    'is_active' => request()->is('dashboard/assignments*'),
                ],
                'instructor_discussions' => [
                    'name' => __t('discussions') . $pendingDiscusionBadge,
                    'icon' => '<i class="la la-question-circle-o"></i>',
                    'url' => route('instructor_discussions'),
                    'is_active' => request()->is('dashboard/discussions*'),
                ],
            ];
        } else if(request()->is('dashboard/reviews-i-wrote*') || request()->is('dashboard/my-courses-reviews')) {
            $menu_array = [
                'reviews_i_wrote' => [
                    'name' => __t('reviews'),
                    'icon' => '<i class="la la-star-half-alt"></i>',
                    'url' => route('reviews_i_wrote'),
                    'is_active' => request()->is('dashboard/reviews-i-wrote*'),
                ],
                'my_courses_reviews' => [
                    'name' => __t('my_courses_reviews'),
                    'icon' => '<i class="la la-star"></i>',
                    'url' => route('my_courses_reviews'),
                    'is_active' => request()->is('dashboard/my-courses-reviews*'),
                ],
            ];
        } else if(request()->is('dashboard/earning*') || request()->is('dashboard/withdraw*')) {
            $menu_array = [
                'earning' => [
                    'name' => __t('earnings'),
                    'icon' => '<i class="la la-comment-dollar"></i>',
                    'url' => route('earning'),
                    'is_active' => request()->is('dashboard/earning') || request()->is('dashboard/earning/report')
                ],
                'withdraw' => [
                    'name' => __t('withdraw'),
                    'icon' => '<i class="la la-wallet"></i>',
                    'url' => route('withdraw'),
                    'is_active' => request()->is('dashboard/withdraw*'),
                ],
            ];
        } else if(request()->is('dashboard/settings*') || request()->is('dashboard/purchases*')) {
            $menu_array = [
                'purchase_history' => [
                    'name' => __t('purchase_history'),
                    'icon' => '<i class="la la-history"></i>',
                    'url' => route('purchase_history'),
                    'is_active' => request()->is('dashboard/purchases*'),
                ],
                'profile_settings' => [
                    'name' => __t('profile_settings'),
                    'icon' => '<i class="la la-tools"></i>',
                    'url' => route('profile_settings'),
                    'is_active' => request()->is('dashboard/settings'),
                ],
                'reset_password' => [
                    'name' => __t('reset_password'),
                    'icon' => '<i class="la la-tools"></i>',
                    'url' => route('profile_reset_password'),
                    'is_active' => request()->is('dashboard/settings/reset-password*'),
                ]
            ];

            if($user->isAdmin()) {
                $menu_array['admin'] = [
                    'name' => __t('go_to_admin'),
                    'icon' => '<i class="la la-cogs"></i>',
                    'url' => route('admin'),
                    'is_active' => request()->is('logout'),
                ];
            }

            $menu_array['logout'] = [
                'name' => __t('logout'),
                'icon' => '<i class="la la-tools"></i>',
                'url' => route('logout'),
                'is_active' => request()->is('logout'),
            ];

        } else {
            $menu_array = [];
        }

        // $menu = apply_filters('dashboard_submenu_for_instructor', [
        //     'create_course' => [
        //         'name' => __t('create_new_course'),
        //         'icon' => '<i class="la la-chalkboard-teacher"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/courses/new'),
        //     ],
        //     'my_courses' => [
        //         'name' => __t('my_courses'),
        //         'icon' => '<i class="la la-graduation-cap"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/my-courses'),
        //     ],
        //     'earning' => [
        //         'name' => __t('earnings'),
        //         'icon' => '<i class="la la-comment-dollar"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/earning*')
        //     ],
        //     'withdraw' => [
        //         'name' => __t('withdraw'),
        //         'icon' => '<i class="la la-wallet"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/withdraw*'),
        //     ],
        //     'my_courses_reviews' => [
        //         'name' => __t('my_courses_reviews'),
        //         'icon' => '<i class="la la-star"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/my-courses-reviews*'),
        //     ],
        //     'courses_has_quiz' => [
        //         'name' => __t('quiz_attempts'),
        //         'icon' => '<i class="la la-check-double"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/courses-has-quiz*'),
        //     ],
        //     'courses_has_assignments' => [
        //         'name' => __t('assignments'),
        //         'icon' => '<i class="la la-star"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/assignments*'),
        //     ],
        //     'instructor_discussions' => [
        //         'name' => __t('discussions') . $pendingDiscusionBadge,
        //         'icon' => '<i class="la la-question-circle-o"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/discussions*'),
        //     ]
        // ]);

        // $menu = $menu + apply_filters('dashboard_submenu_for_users', [
        //     'enrolled_courses' => [
        //         'name' => __t('enrolled_courses'),
        //         'icon' => '<i class="la la-pencil-square-o"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/enrolled-courses*'),
        //     ],
        //     'wishlist' => [
        //         'name' => __t('wishlist'),
        //         'icon' => '<i class="la la-heart-o"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/wishlist*'),
        //     ],
        //     'reviews_i_wrote' => [
        //         'name' => __t('reviews'),
        //         'icon' => '<i class="la la-star-half-alt"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/reviews-i-wrote*'),
        //     ],
        //     'my_quiz_attempts' => [
        //         'name' => __t('my_quiz_attempts'),
        //         'icon' => '<i class="la la-question-circle-o"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/my-quiz-attempts*'),
        //     ],
        //     'purchase_history' => [
        //         'name' => __t('purchase_history'),
        //         'icon' => '<i class="la la-history"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/purchases*'),
        //     ],
        //     'profile_settings' => [
        //         'name' => __t('settings'),
        //         'icon' => '<i class="la la-tools"></i>',
        //         'url' => '#',
        //         'is_active' => request()->is('dashboard/settings*'),
        //     ],
        // ]);
        $menu = apply_filters('dashboard_submenu_for_users', $menu_array);

    } else if($user->isStudent()) {

        if(request()->is('dashboard/enrolled-courses*') || request()->is('dashboard/wishlist*') || request()->is('dashboard/my-quiz-attempts*')) {
            $menu_array = [
                'enrolled_courses' => [
                    'name' => __t('enrolled_courses'),
                    'icon' => '<i class="la la-pencil-square-o"></i>',
                    'url' => route('enrolled_courses'),
                    'is_active' => request()->is('dashboard/enrolled-courses*') || request()->is('dashboard/wishlist*'),
                ],
                'wishlist' => [
                    'name' => __t('wishlist'),
                    'icon' => '<i class="la la-heart-o"></i>',
                    'url' => route('wishlist'),
                    'is_active' => request()->is('dashboard/enrolled-courses*') || request()->is('dashboard/wishlist*'),
                ],
                'my_quiz_attempts' => [
                    'name' => __t('my_quiz_attempts'),
                    'icon' => '<i class="la la-question-circle-o"></i>',
                    'url' => route('my_quiz_attempts'),
                    'is_active' => request()->is('dashboard/my-quiz-attempts*'),
                ],
            ];
        } else if(request()->is('dashboard/reviews-i-wrote*')) {
            $menu_array = [
                'reviews_i_wrote' => [
                    'name' => __t('reviews'),
                    'icon' => '<i class="la la-star-half-alt"></i>',
                    'url' => route('reviews_i_wrote'),
                    'is_active' => request()->is('dashboard/reviews-i-wrote*'),
                ],
            ];
        } else if(request()->is('dashboard/settings*') || request()->is('dashboard/purchases*')) {
            $menu_array = [
                'purchase_history' => [
                    'name' => __t('purchase_history'),
                    'icon' => '<i class="la la-history"></i>',
                    'url' => route('purchase_history'),
                    'is_active' => request()->is('dashboard/purchases*'),
                ],
                'profile_settings' => [
                    'name' => __t('profile_settings'),
                    'icon' => '<i class="la la-tools"></i>',
                    'url' => route('profile_settings'),
                    'is_active' => request()->is('dashboard/settings*'),
                ],
                'reset_password' => [
                    'name' => __t('reset_password'),
                    'icon' => '<i class="la la-tools"></i>',
                    'url' => route('profile_reset_password'),
                    'is_active' => request()->is('dashboard/settings/reset-password*'),
                ],
                'logout' => [
                    'name' => __t('logout'),
                    'icon' => '<i class="la la-tools"></i>',
                    'url' => route('logout'),
                    'is_active' => request()->is('logout'),
                ],
            ];
        } else {
            $menu_array = [];
        }

        $menu = apply_filters('dashboard_submenu_for_users', $menu_array);
    }

    return apply_filters('dashboard_submenu_items', $menu);
}

function sidebar_menu(){
    $menu = [];

    $user = \Illuminate\Support\Facades\Auth::user();

    if ($user->isInstructor()) {

        $pendingDiscusionBadge = '';
        $pendingDiscussionCount = $user->instructor_discussions->where('replied', 0)->count();
        if ($pendingDiscussionCount){
            $pendingDiscusionBadge = "<span class='badge badge-warning float-right'> {$pendingDiscussionCount} </span>";
        }

        $menu = apply_filters('sidebar_menu_for_instructor', [
            'enrolled_courses' => [
                'name' => __t('enrolled_courses'),
                'icon' => '<i class="la la-pencil-square-o"></i>',
                'is_active' => request()->is('dashboard/enrolled-courses*'),
            ],
            'wishlist' => [
                'name' => __t('wishlist'),
                'icon' => '<i class="la la-heart-o"></i>',
                'is_active' => request()->is('dashboard/wishlist*'),
            ],
            'my_courses' => [
                'name' => __t('my_courses'),
                'icon' => '<i class="la la-graduation-cap"></i>',
                'is_active' => request()->is('dashboard/my-courses'),
            ],
            'earning' => [
                'name' => __t('earnings'),
                'icon' => '<i class="la la-comment-dollar"></i>',
                'is_active' => request()->is('dashboard/earning*')
            ],

            // 'withdraw' => [
            //     'name' => __t('withdraw'),
            //     'icon' => '<i class="la la-wallet"></i>',
            //     'is_active' => request()->is('dashboard/withdraw*'),
            // ],
            // 'my_courses_reviews' => [
            //     'name' => __t('my_courses_reviews'),
            //     'icon' => '<i class="la la-star"></i>',
            //     'is_active' => request()->is('dashboard/my-courses-reviews*'),
            // ],
            // 'courses_has_quiz' => [
            //     'name' => __t('quiz_attempts'),
            //     'icon' => '<i class="la la-check-double"></i>',
            //     'is_active' => request()->is('dashboard/courses-has-quiz*'),
            // ],
            // 'courses_has_assignments' => [
            //     'name' => __t('assignments'),
            //     'icon' => '<i class="la la-star"></i>',
            //     'is_active' => request()->is('dashboard/assignments*'),
            // ],
            // 'instructor_discussions' => [
            //     'name' => __t('discussions') . $pendingDiscusionBadge,
            //     'icon' => '<i class="la la-question-circle-o"></i>',
            //     'is_active' => request()->is('dashboard/discussions*'),
            // ]
        ]);

        $menu = $menu + apply_filters('sidebar_menu_for_users', [
            // 'enrolled_courses' => [
            //     'name' => __t('enrolled_courses'),
            //     'icon' => '<i class="la la-pencil-square-o"></i>',
            //     'is_active' => request()->is('dashboard/enrolled-courses*'),
            // ],
            // 'wishlist' => [
            //     'name' => __t('wishlist'),
            //     'icon' => '<i class="la la-heart-o"></i>',
            //     'is_active' => request()->is('dashboard/wishlist*'),
            // ],
            // 'reviews_i_wrote' => [
            //     'name' => __t('reviews'),
            //     'icon' => '<i class="la la-star-half-alt"></i>',
            //     'is_active' => request()->is('dashboard/reviews-i-wrote*'),
            // ],
            // 'my_quiz_attempts' => [
            //     'name' => __t('my_quiz_attempts'),
            //     'icon' => '<i class="la la-question-circle-o"></i>',
            //     'is_active' => request()->is('dashboard/my-quiz-attempts*'),
            // ],
            // 'purchase_history' => [
            //     'name' => __t('purchase_history'),
            //     'icon' => '<i class="la la-history"></i>',
            //     'is_active' => request()->is('dashboard/purchases*'),
            // ],
            'profile_settings' => [
                'name' => __t('account'),
                'icon' => '<i class="la la-tools"></i>',
                'is_active' => request()->is('dashboard/settings*'),
            ],
        ]);

    } else if($user->isStudent()) {
        $menu = apply_filters('sidebar_menu_for_users', [
            'enrolled_courses' => [
                'name' => __t('enrolled_courses'),
                'icon' => '<span class="menu_icon mr-2"><img src="'.url('uploads/images/Enrolled Courses.png').'"></span>',
                'is_active' => request()->is('dashboard/enrolled-courses*'),
            ],
            'wishlist' => [
                'name' => __t('wishlist'),
                'icon' => '<span class="menu_icon mr-2"><img src="'.url('uploads/images/Wishlist.png').'"></span>',
                'is_active' => request()->is('dashboard/wishlist*'),
            ],
            'purchase_history' => [
                'name' => __t('account'),
                'icon' => '<span class="menu_icon mr-2"><img src="'.url('uploads/images/Account.png').'"></span>',
                'is_active' => request()->is('dashboard/settings*'),
            ],
        ]);
    }


    // if ($user->is_admin){
    //     $menu['admin'] = [
    //         'name' => __t('go_to_admin'),
    //         'icon' => '<i class="la la-cogs"></i>',
    //     ];
    // }

    return apply_filters('sidebar_menu_items', $menu);
}


function course_edit_navs(){

    $nav_items = apply_filters('course_edit_nav_items', [
        'edit_course_information' => [
            'name' => __t('information'),
            'icon' => '<i class="la la-info-circle"></i>',
            'is_active' => request()->is('dashboard/courses/*/information'),
        ],
        'edit_course_curriculum' => [
            'name' => __t('curriculum'),
            'icon' => '<i class="la la-th-list"></i>',
            'is_active' => request()->is('dashboard/courses/*/curriculum'),
        ],
        'edit_course_pricing' => [
            'name' => __t('pricing'),
            'icon' => '<i class="la la-cart-arrow-down"></i>',
            'is_active' => request()->is('dashboard/courses/*/pricing'),
        ],
        'edit_course_drip' => [
            'name' => __t('drip'),
            'icon' => '<i class="la la-fill-drip"></i>',
            'is_active' => request()->is('dashboard/courses/*/drip'),
        ],

    ]);


    return $nav_items;
}
