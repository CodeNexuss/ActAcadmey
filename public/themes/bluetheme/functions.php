<?php

function generateBreadcrumb($category){
    $homeUrl = "<li class='breadcrumb-item'><a href='".route('home')."'><i class='la la-home'></i>  ".__t('home')."</a></li>";

    $breadCumb = "<ol class='breadcrumb mb-0'>".$homeUrl;

    $html = "<li class='breadcrumb-item active'>{$category->category_name}</li>";

    while ($category->parent_category){
        $category = $category->parent_category;
        $currentName = "<li class='breadcrumb-item'><a href='".route('category_view', $category->slug)."'>{$category->category_name}</a></li>";

        $html = $currentName.' '.$html;
    }
    $breadCumb .= $html.'</ol>';

    return $breadCumb;
}


if ( ! function_exists('form_error')){
    function form_error($errors = null, $error_key = ''){

        $response = [
            'class' => '',
            'message' => '',
        ];

        if ($errors && $errors->has($error_key)){
            $response = [
                'class' => ' has-error ',
                'message' => "<span class='invalid-feedback'><strong>{$errors->first($error_key)}</strong></span>",
            ];
        }

        return (object) $response;
    }
}
