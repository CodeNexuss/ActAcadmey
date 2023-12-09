<?php


/**
 * Include Laravel default helpers
 */

use App\Complete;
use App\Content;
use App\Post;
use App\Review;
use App\Course;
use App\Labels;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/helpers.php';
require __DIR__.'/theme_functions.php';

/**
 * @return string
 */
if ( ! function_exists('pageJsonData')){
    function pageJsonData(){
        $data = [
            'home_url' => route('home'),
            'asset_url' => asset('assets'),
            'csrf_token' => csrf_token(),
            'is_logged_in' => auth()->check(),
            'dashboard' => route('dashboard'),
            'cookie_html' => get_option('cookie_alert.enable') ? cookie_message_html() : '',
        ];

        $routeLists = \Illuminate\Support\Facades\Route::getRoutes();

        $routes = [];
        foreach ($routeLists as $route){
            $routes[$route->getName()] = $data['home_url'].'/'.$route->uri;
        }
        $data['routes'] = $routes;

        return apply_filters('page_json_data', $data);
    }
}


/**
 * @param string $title
 * @param $model
 * @return string
 */

function unique_slug($title = '', $model = 'Course', $skip_id = 0){
    $slug = str_slug($title);

    if (empty($slug)){
        $string = mb_strtolower($title, "UTF-8");;
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $slug = preg_replace("/[\s_]/", '-', $string);
    }

    //get unique slug...
    $nSlug = $slug;
    $i = 0;

    $model = str_replace(' ','',"\App\ ".$model);

    if ($skip_id === 0) {
        while (($model::whereSlug($nSlug)->count()) > 0) {
            $i++;
            $nSlug = $slug . '-' . $i;
        }
    }else{
        while (($model::whereSlug($nSlug)->where('id', '!=', $skip_id)->count()) > 0) {
            $i++;
            $nSlug = $slug . '-' . $i;
        }
    }
    if($i > 0) {
        $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
    } else {
        $newSlug = $slug;
    }
    return $newSlug;
}


function next_curriculum_item_id($course_id){
    $order_number = (int) DB::table('contents')->where('course_id', $course_id)->max('sort_order');
    return $order_number + 1;
}

/**
 * @return mixed
 * Return the current Disk
 */
if ( ! function_exists('current_disk')){
    function current_disk(){
        $current_disk = \Illuminate\Support\Facades\Storage::disk(get_option('default_storage'));
        return $current_disk;
    }
}

/**
 * @param string $key
 * @return string
 */
function get_option($key = '', $default = null){
    $options = config('options');
    if (! $key){
        return $options;
    }

    $value = get_from_array($key, $options);
    if ($value){
        return $value;
    }

    return apply_filters('options', $default);
}

function get_from_array($key = null, $arr = []){
    if (strpos($key, '.') === false){
        $value = array_get($arr, $key);
        if ($value){
            if (is_string($value) && substr($value, 0, 18) === 'json_encode_value_'){
                $value = json_decode(substr($value, 18), true);
            }
            return $value;
        }
    }else{

        $firstKey = substr($key, 0, strpos($key, '.'));
        $secondKey = substr($key, strpos($key, '.')+1);

        $value = array_get($arr, $firstKey);
        if ($value){
            if (is_string($value) && substr($value, 0, 18) === 'json_encode_value_'){
                $value = json_decode(substr($value, 18), true);
            }
            return array_get($value, $secondKey);
        }
    }
    return null;
}

function update_option($key, $value){
    $option = \App\Option::firstOrCreate(['option_key' => $key]);
    $option->option_value = $value;
    return $option->save();
}

function delete_option($key){
    \App\Option::whereOptionKey($key)->delete();
}


/**
 * @param null $key
 * @return mixed|null
 *
 * return theme translation from theme directory
 */
if ( ! function_exists('__t')) {
    function __t($key = null){
        $language = config('lang_str');
        $text = array_get($language, $key);

        if ($text) {
            return  $text;
        }
        return $key;
    }
}

/**
 * @param null $key
 * @return array|\Illuminate\Contracts\Translation\Translator|string|null
 *
 * returning Admin panel translation from resources/lang
 */
if ( ! function_exists('__a')){
    function __a($key = null){
        if ($key){
            return __("admin.{$key}");
        }
        return $key;
    }
}


if ( ! function_exists('get_theme')) {
    function get_theme(){
        $theme_slug = get_option('current_theme', 'bluetheme');
        $theme_path = public_path("themes/{$theme_slug}/");
        $theme_url = asset("themes/{$theme_slug}");

        $info = [
            'name' => 'bluetheme',
            'version' => '1.0.0',
            'slug' => $theme_slug,
            'view' => "themes.{$theme_slug}.",
            'path' => $theme_path,
            'url' => $theme_url,
        ];
        return (object)$info;
    }
}


/**
 * @param null $view
 * @return string
 *
 * Return current theme directory
 */
if ( ! function_exists('theme')) {
    function theme($view = null){
        return get_theme()->view . $view;
    }
}

if ( ! function_exists('theme_asset')) {
    function theme_asset($path = ''){
        return get_theme()->url . '/assets/' . $path;
    }
}

if ( ! function_exists('theme_url')){
    function theme_url($path = ''){
        return get_theme()->url . '/' . $path;
    }
}

/**
 * @param null $view
 * @param array $data
 * @param array $mergeData
 * @return string
 *
 */

if ( ! function_exists('view_template')) {
    function view_template($view = null, $data = [], $mergeData = []){
        $view_dir = get_theme()->view;

        $html = view()->make($view_dir . 'header', $data, $mergeData)->render();
        $html .= view()->make($view_dir . $view, $data, $mergeData)->render();
        $html .= view()->make($view_dir . 'footer', $data, $mergeData)->render();

        return $html;
    }
}
/*
function view_dashboard_template($view = null, $data = [], $mergeData = []){
    $data = array_merge($data, array('view' => 'dashboard.'.$view));
    return view_template('dashboard.index', $data, $mergeData);
}*/

/**
 * @param null $view
 * @param array $data
 * @param array $mergeData
 * @return string
 *
 * Load a template part without header/footer
 */

if ( ! function_exists('view_template_part')) {
    function view_template_part($view = null, $data = [], $mergeData = []){
        return view()->make(theme($view), $data, $mergeData)->render();
    }
}

/**
 * @param null $media
 * @return object
 *
 * Get Media Image URL
 */
if ( ! function_exists('media_image_uri')){
    function media_image_uri($media = null){
        $sizes = config('media.size');
        $sizes['original'] = "Original Image";
        $sizes['full'] = "Original Image";

        foreach ($sizes as $img_size => $name){
            $sizes[$img_size] = asset('uploads/placeholder-image.png?v='.time());
        }

        if ($media){
            if ( ! is_object($media) || ! $media instanceof \App\Media){
                $media = \App\Media::find($media);
            }

            if ($media){
                $source = get_option('default_storage');

                $url_path       = null;
                $full_url_path  = null;

                //Getting resized images
                foreach ($sizes as $img_size => $name){
                    if ($img_size === 'original' || $img_size === 'full'){
                        $thumb_size = '';
                    }else{
                        $thumb_size = $img_size.'/';
                    }

                    if ($source == 'public'){
                        $url_path = asset("uploads/images/{$thumb_size}".$media->slug_ext);
                    }elseif ($source == 's3'){
                        try {
                            $url_path = \Illuminate\Support\Facades\Storage::disk('s3')->url("uploads/images/{$thumb_size}".$media->slug_ext);
                        }catch (\Exception $exception){
                            //
                        }
                    }
                    $sizes[$img_size] = $url_path;
                }

            }
        }

        return (object) $sizes;
    }
}


/**
 * @param null $media
 * @return string|null
 *
 * Get Uploaded File Original URL
 */

if ( ! function_exists('media_file_uri')){
    function media_file_uri($media = null){
        $url_path       = null;

        if ($media){
            if ( ! is_object($media) || ! $media instanceof \App\Media){
                $media = \App\Media::find($media);
            }

            if ($media){
                $source = get_option('default_storage');
                $slug_ext = $media->slug_ext;
                if (substr($media->mime_type, 0, 5) == 'image') {
                    $slug_ext = 'images/'.$slug_ext;
                }

                if ($source == 'public'){
                    $url_path = asset("uploads/".$slug_ext);
                }elseif ($source == 's3'){

                    try {
                        $url_path = \Illuminate\Support\Facades\Storage::disk('s3')->url("uploads/".$slug_ext);
                    }catch(\Exception $exception){
                        add_action('admin_notices', function()use ($exception){
                            echo "<div class='alert alert-danger'> <strong>File Storage S3 Settings Error:</strong>
 {$exception->getMessage()}</div>";
                        });
                        //
                    }

                }
            }
        }

        return $url_path;
    }
}


/**
 * @param $media_id
 * @param bool $echo
 * @return string
 *
 */

if ( ! function_exists('media_image_uri_attr')){
    function media_image_uri_attr($media, $echo = false){
        $get_all_size = media_image_uri($media);

        $attr = '';
        if ( ! empty($get_all_size)){
            foreach ($get_all_size as $size => $uri){
                $attr .= " data-image-size-{$size}={$uri} ";
            }
        }

        if ($echo){
            echo $attr;
        }else{
            return $attr;
        }
    }
}

if ( ! function_exists('image_upload_form')){

    /**
     * @param string $input_name
     * @param string $current_image_id
     * @param array $preferable_size
     */

    function image_upload_form($input_name = 'image_id', $current_image_id = '', $preferable_size = [], $only_image = false){
        if ( ! $input_name){
            $input_name = 'image_id';
        }
        ?>
        <div class="image-wrap admin_img">
            <a href="javascript:;" data-toggle="filemanager" class="<?php echo ($only_image) ? 'image-only' : ''; ?>">
                <?php
                $img_src = '';
                if ($current_image_id){
                    $img_src = media_image_uri($current_image_id)->thumbnail;
                }else{
                    $img_src = asset('uploads/placeholder-image.png?v='.time());
                }
                ?>
                <img src="<?php echo $img_src; ?>" alt="" class="img-thumbnail" />
            </a>
            <input type="hidden" name="<?php echo $input_name; ?>" id="<?php echo $input_name; ?>" class="image-input" value="<?php echo $current_image_id; ?>">

            <?php
            if (count($preferable_size)){
                $width = array_get($preferable_size, 0);
                $height = array_get($preferable_size, 1);
                $text = __t('preferable_size') .": w-{$width}px X h-{$height}px";
                echo "<p class='img_preferable_size_info my-2 text-info'> {$text} </p>";
            }
            ?>

        </div>
        <?php
    }
}



if ( ! function_exists('media_upload_form')){

    /**
     * @param string $input_name
     * @param string $btn_text
     * @param string $current_media_id
     */

    function media_upload_form($input_name = 'media_id', $btn_text = 'Upload Media', $btn_class = null, $current_media_id = ''){
        if ( ! $input_name){
            $input_name = 'media_id';
        }
        $btn_class = $btn_class ? $btn_class : 'btn btn-primary';
        ?>
        <div class="image-wrap media-btn-wrap">
            <div class="saved-media-id">
                <?php if ($current_media_id){
                    echo "<p class='text-info'>#<strong>{$current_media_id}</strong></p>";
                } ?>
            </div>
            <a href="javascript:;" class="<?php echo $btn_class; ?>" data-toggle="filemanager">
                <?php echo $btn_text; ?>
            </a>
            <input type="hidden" name="<?php echo $input_name; ?>" class="image-input" value="<?php echo $current_media_id; ?>">
        </div>
        <?php
    }
}

/**
 * @param instance $course_instance
 */
function course_url($course_instance){
    return route('course', $course_instance->slug);
}

if ( ! function_exists('date_time_format')) {
    function date_time_format(){
        return get_option('date_format') . ' ' . get_option('time_format');
    }
}

function get_currency(){
    return get_option('currency_sign');
}

function price_format($amount = 0, $currency = null){
    $show_price = '';
    $currency_position = get_option('currency_position');

    if ( ! $currency){
        $currency = get_option('currency_sign');
    }

    $currency_sign = get_currency_symbol($currency);
    $get_price = get_amount_raw($amount);

    if ($currency_position == 'right'){
        $show_price = $get_price.''.$currency_sign;
    }else{
        $show_price = $currency_sign.''.$get_price;
    }

    return $show_price;
}


function get_amount_raw($amount = 0 ){
    $get_price = '0.00';
    $none_decimal_currencies = get_zero_decimal_currency();

    if (in_array(get_option('currency_sign'), $none_decimal_currencies)){
        $get_price = (int) $amount;
    }else{
        if ($amount > 0){
            $get_price = number_format($amount,2);
        }
    }

    return $get_price;
}


if ( ! function_exists('get_zero_decimal_currency')) {
    function get_zero_decimal_currency(){
        $zero_decimal_currency = [
            'BIF',
            'MGA',
            'CLP',
            'PYG',
            'DJF',
            'RWF',
            'GNF',
            'UGX',
            'JPY',
            'VND',
            'VUV',
            'KMF',
            'XAF',
            'KRW',
            'XOF',
            'XPF',
        ];

        return $zero_decimal_currency;
    }
}


if ( ! function_exists('get_stripe_amount')) {
    function get_stripe_amount($amount = 0, $type = 'to_cents'){
        if ( ! $amount){
            return $amount;
        }

        $non_decimal_currency = get_zero_decimal_currency();

        if (in_array(get_option('currency_sign'), $non_decimal_currency)) {
            return $amount;
        }

        if ($type === 'to_cents'){
            return (int) round(($amount * 100));
        }
        return $amount / 100;
    }
}

/**
 * @return array
 *
 * Get currencies
 */

function get_currencies(){
    return array(
        'AED' => 'United Arab Emirates dirham',
        'AFN' => 'Afghan afghani',
        'ALL' => 'Albanian lek',
        'AMD' => 'Armenian dram',
        'ANG' => 'Netherlands Antillean guilder',
        'AOA' => 'Angolan kwanza',
        'ARS' => 'Argentine peso',
        'AUD' => 'Australian dollar',
        'AWG' => 'Aruban florin',
        'AZN' => 'Azerbaijani manat',
        'BAM' => 'Bosnia and Herzegovina convertible mark',
        'BBD' => 'Barbadian dollar',
        'BDT' => 'Bangladeshi taka',
        'BGN' => 'Bulgarian lev',
        'BHD' => 'Bahraini dinar',
        'BIF' => 'Burundian franc',
        'BMD' => 'Bermudian dollar',
        'BND' => 'Brunei dollar',
        'BOB' => 'Bolivian boliviano',
        'BRL' => 'Brazilian real',
        'BSD' => 'Bahamian dollar',
        'BTC' => 'Bitcoin',
        'BTN' => 'Bhutanese ngultrum',
        'BWP' => 'Botswana pula',
        'BYR' => 'Belarusian ruble',
        'BZD' => 'Belize dollar',
        'CAD' => 'Canadian dollar',
        'CDF' => 'Congolese franc',
        'CHF' => 'Swiss franc',
        'CLP' => 'Chilean peso',
        'CNY' => 'Chinese yuan',
        'COP' => 'Colombian peso',
        'CRC' => 'Costa Rican col&oacute;n',
        'CUC' => 'Cuban convertible peso',
        'CUP' => 'Cuban peso',
        'CVE' => 'Cape Verdean escudo',
        'CZK' => 'Czech koruna',
        'DJF' => 'Djiboutian franc',
        'DKK' => 'Danish krone',
        'DOP' => 'Dominican peso',
        'DZD' => 'Algerian dinar',
        'EGP' => 'Egyptian pound',
        'ERN' => 'Eritrean nakfa',
        'ETB' => 'Ethiopian birr',
        'EUR' => 'Euro',
        'FJD' => 'Fijian dollar',
        'FKP' => 'Falkland Islands pound',
        'GBP' => 'Pound sterling',
        'GEL' => 'Georgian lari',
        'GGP' => 'Guernsey pound',
        'GHS' => 'Ghana cedi',
        'GIP' => 'Gibraltar pound',
        'GMD' => 'Gambian dalasi',
        'GNF' => 'Guinean franc',
        'GTQ' => 'Guatemalan quetzal',
        'GYD' => 'Guyanese dollar',
        'HKD' => 'Hong Kong dollar',
        'HNL' => 'Honduran lempira',
        'HRK' => 'Croatian kuna',
        'HTG' => 'Haitian gourde',
        'HUF' => 'Hungarian forint',
        'IDR' => 'Indonesian rupiah',
        'ILS' => 'Israeli new shekel',
        'IMP' => 'Manx pound',
        'INR' => 'Indian rupee',
        'IQD' => 'Iraqi dinar',
        'IRR' => 'Iranian rial',
        'ISK' => 'Icelandic kr&oacute;na',
        'JEP' => 'Jersey pound',
        'JMD' => 'Jamaican dollar',
        'JOD' => 'Jordanian dinar',
        'JPY' => 'Japanese yen',
        'KES' => 'Kenyan shilling',
        'KGS' => 'Kyrgyzstani som',
        'KHR' => 'Cambodian riel',
        'KMF' => 'Comorian franc',
        'KPW' => 'North Korean won',
        'KRW' => 'South Korean won',
        'KWD' => 'Kuwaiti dinar',
        'KYD' => 'Cayman Islands dollar',
        'KZT' => 'Kazakhstani tenge',
        'LAK' => 'Lao kip',
        'LBP' => 'Lebanese pound',
        'LKR' => 'Sri Lankan rupee',
        'LRD' => 'Liberian dollar',
        'LSL' => 'Lesotho loti',
        'LYD' => 'Libyan dinar',
        'MAD' => 'Moroccan dirham',
        'MDL' => 'Moldovan leu',
        'MGA' => 'Malagasy ariary',
        'MKD' => 'Macedonian denar',
        'MMK' => 'Burmese kyat',
        'MNT' => 'Mongolian t&ouml;gr&ouml;g',
        'MOP' => 'Macanese pataca',
        'MRO' => 'Mauritanian ouguiya',
        'MUR' => 'Mauritian rupee',
        'MVR' => 'Maldivian rufiyaa',
        'MWK' => 'Malawian kwacha',
        'MXN' => 'Mexican peso',
        'MYR' => 'Malaysian ringgit',
        'MZN' => 'Mozambican metical',
        'NAD' => 'Namibian dollar',
        'NGN' => 'Nigerian naira',
        'NIO' => 'Nicaraguan c&oacute;rdoba',
        'NOK' => 'Norwegian krone',
        'NPR' => 'Nepalese rupee',
        'NZD' => 'New Zealand dollar',
        'OMR' => 'Omani rial',
        'PAB' => 'Panamanian balboa',
        'PEN' => 'Peruvian nuevo sol',
        'PGK' => 'Papua New Guinean kina',
        'PHP' => 'Philippine peso',
        'PKR' => 'Pakistani rupee',
        'PLN' => 'Polish z&#x142;oty',
        'PRB' => 'Transnistrian ruble',
        'PYG' => 'Paraguayan guaran&iacute;',
        'QAR' => 'Qatari riyal',
        'RON' => 'Romanian leu',
        'RSD' => 'Serbian dinar',
        'RUB' => 'Russian ruble',
        'RWF' => 'Rwandan franc',
        'SAR' => 'Saudi riyal',
        'SBD' => 'Solomon Islands dollar',
        'SCR' => 'Seychellois rupee',
        'SDG' => 'Sudanese pound',
        'SEK' => 'Swedish krona',
        'SGD' => 'Singapore dollar',
        'SHP' => 'Saint Helena pound',
        'SLL' => 'Sierra Leonean leone',
        'SOS' => 'Somali shilling',
        'SRD' => 'Surinamese dollar',
        'SSP' => 'South Sudanese pound',
        'STD' => 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra',
        'SYP' => 'Syrian pound',
        'SZL' => 'Swazi lilangeni',
        'THB' => 'Thai baht',
        'TJS' => 'Tajikistani somoni',
        'TMT' => 'Turkmenistan manat',
        'TND' => 'Tunisian dinar',
        'TOP' => 'Tongan pa&#x2bb;anga',
        'TRY' => 'Turkish lira',
        'TTD' => 'Trinidad and Tobago dollar',
        'TWD' => 'New Taiwan dollar',
        'TZS' => 'Tanzanian shilling',
        'UAH' => 'Ukrainian hryvnia',
        'UGX' => 'Ugandan shilling',
        'USD' => 'United States dollar',
        'UYU' => 'Uruguayan peso',
        'UZS' => 'Uzbekistani som',
        'VEF' => 'Venezuelan bol&iacute;var',
        'VND' => 'Vietnamese &#x111;&#x1ed3;ng',
        'VUV' => 'Vanuatu vatu',
        'WST' => 'Samoan t&#x101;l&#x101;',
        'XAF' => 'Central African CFA franc',
        'XCD' => 'East Caribbean dollar',
        'XOF' => 'West African CFA franc',
        'XPF' => 'CFP franc',
        'YER' => 'Yemeni rial',
        'ZAR' => 'South African rand',
        'ZMW' => 'Zambian kwacha',
    );
}


/**
 * Get Currency symbol.
 *
 * @param string $currency (default: '')
 * @return string
 */
if ( ! function_exists('get_currency_symbol')) {
    function get_currency_symbol($currency = ''){
        if (!$currency) {
            $currency = 'USD';
        }

        $symbols = array(
            'AED' => '&#x62f;.&#x625;',
            'AFN' => '&#x60b;',
            'ALL' => 'L',
            'AMD' => 'AMD',
            'ANG' => '&fnof;',
            'AOA' => 'Kz',
            'ARS' => '&#36;',
            'AUD' => '&#36;',
            'AWG' => '&fnof;',
            'AZN' => 'AZN',
            'BAM' => 'KM',
            'BBD' => '&#36;',
            'BDT' => '&#2547;&nbsp;',
            'BGN' => '&#1083;&#1074;.',
            'BHD' => '.&#x62f;.&#x628;',
            'BIF' => 'Fr',
            'BMD' => '&#36;',
            'BND' => '&#36;',
            'BOB' => 'Bs.',
            'BRL' => '&#82;&#36;',
            'BSD' => '&#36;',
            'BTC' => '&#3647;',
            'BTN' => 'Nu.',
            'BWP' => 'P',
            'BYR' => 'Br',
            'BZD' => '&#36;',
            'CAD' => '&#36;',
            'CDF' => 'Fr',
            'CHF' => '&#67;&#72;&#70;',
            'CLP' => '&#36;',
            'CNY' => '&yen;',
            'COP' => '&#36;',
            'CRC' => '&#x20a1;',
            'CUC' => '&#36;',
            'CUP' => '&#36;',
            'CVE' => '&#36;',
            'CZK' => '&#75;&#269;',
            'DJF' => 'Fr',
            'DKK' => 'DKK',
            'DOP' => 'RD&#36;',
            'DZD' => '&#x62f;.&#x62c;',
            'EGP' => 'EGP',
            'ERN' => 'Nfk',
            'ETB' => 'Br',
            'EUR' => '&euro;',
            'FJD' => '&#36;',
            'FKP' => '&pound;',
            'GBP' => '&pound;',
            'GEL' => '&#x10da;',
            'GGP' => '&pound;',
            'GHS' => '&#x20b5;',
            'GIP' => '&pound;',
            'GMD' => 'D',
            'GNF' => 'Fr',
            'GTQ' => 'Q',
            'GYD' => '&#36;',
            'HKD' => '&#36;',
            'HNL' => 'L',
            'HRK' => 'Kn',
            'HTG' => 'G',
            'HUF' => '&#70;&#116;',
            'IDR' => 'Rp',
            'ILS' => '&#8362;',
            'IMP' => '&pound;',
            'INR' => '&#8377;',
            'IQD' => '&#x639;.&#x62f;',
            'IRR' => '&#xfdfc;',
            'ISK' => 'kr.',
            'JEP' => '&pound;',
            'JMD' => '&#36;',
            'JOD' => '&#x62f;.&#x627;',
            'JPY' => '&yen;',
            'KES' => 'KSh',
            'KGS' => '&#x441;&#x43e;&#x43c;',
            'KHR' => '&#x17db;',
            'KMF' => 'Fr',
            'KPW' => '&#x20a9;',
            'KRW' => '&#8361;',
            'KWD' => '&#x62f;.&#x643;',
            'KYD' => '&#36;',
            'KZT' => 'KZT',
            'LAK' => '&#8365;',
            'LBP' => '&#x644;.&#x644;',
            'LKR' => '&#xdbb;&#xdd4;',
            'LRD' => '&#36;',
            'LSL' => 'L',
            'LYD' => '&#x644;.&#x62f;',
            'MAD' => '&#x62f;. &#x645;.',
            'MDL' => 'L',
            'MGA' => 'Ar',
            'MKD' => '&#x434;&#x435;&#x43d;',
            'MMK' => 'Ks',
            'MNT' => '&#x20ae;',
            'MOP' => 'P',
            'MRO' => 'UM',
            'MUR' => '&#x20a8;',
            'MVR' => '.&#x783;',
            'MWK' => 'MK',
            'MXN' => '&#36;',
            'MYR' => '&#82;&#77;',
            'MZN' => 'MT',
            'NAD' => '&#36;',
            'NGN' => '&#8358;',
            'NIO' => 'C&#36;',
            'NOK' => '&#107;&#114;',
            'NPR' => '&#8360;',
            'NZD' => '&#36;',
            'OMR' => '&#x631;.&#x639;.',
            'PAB' => 'B/.',
            'PEN' => 'S/.',
            'PGK' => 'K',
            'PHP' => '&#8369;',
            'PKR' => '&#8360;',
            'PLN' => '&#122;&#322;',
            'PRB' => '&#x440;.',
            'PYG' => '&#8370;',
            'QAR' => '&#x631;.&#x642;',
            'RMB' => '&yen;',
            'RON' => 'lei',
            'RSD' => '&#x434;&#x438;&#x43d;.',
            'RUB' => '&#8381;',
            'RWF' => 'Fr',
            'SAR' => '&#x631;.&#x633;',
            'SBD' => '&#36;',
            'SCR' => '&#x20a8;',
            'SDG' => '&#x62c;.&#x633;.',
            'SEK' => '&#107;&#114;',
            'SGD' => '&#36;',
            'SHP' => '&pound;',
            'SLL' => 'Le',
            'SOS' => 'Sh',
            'SRD' => '&#36;',
            'SSP' => '&pound;',
            'STD' => 'Db',
            'SYP' => '&#x644;.&#x633;',
            'SZL' => 'L',
            'THB' => '&#3647;',
            'TJS' => '&#x405;&#x41c;',
            'TMT' => 'm',
            'TND' => '&#x62f;.&#x62a;',
            'TOP' => 'T&#36;',
            'TRY' => '&#8378;',
            'TTD' => '&#36;',
            'TWD' => '&#78;&#84;&#36;',
            'TZS' => 'Sh',
            'UAH' => '&#8372;',
            'UGX' => 'UGX',
            'USD' => '&#36;',
            'UYU' => '&#36;',
            'UZS' => 'UZS',
            'VEF' => 'Bs F',
            'VND' => '&#8363;',
            'VUV' => 'Vt',
            'WST' => 'T',
            'XAF' => 'Fr',
            'XCD' => '&#36;',
            'XOF' => 'Fr',
            'XPF' => 'Fr',
            'YER' => '&#xfdfc;',
            'ZAR' => '&#82;',
            'ZMW' => 'ZK',
        );

        $currency_symbol = isset($symbols[$currency]) ? $symbols[$currency] : '';

        return $currency_symbol;
    }
}


/**
 * Form Helper
 */

/**
 * @param $checked
 * @param bool $current
 * @param bool $echo
 * @return string
 */

if ( ! function_exists('checked')) {
    function checked($checked, $current = true, $echo = true)
    {
        return __checked_selected_helper($checked, $current, $echo, 'checked');
    }
}
/**
 * @param $selected
 * @param bool $current
 * @param bool $echo
 * @return string
 */

if ( ! function_exists('selected')) {
    function selected($selected, $current = true, $echo = true)
    {
        return __checked_selected_helper($selected, $current, $echo, 'selected');
    }
}

/**
 * @param $helper
 * @param $current
 * @param $echo
 * @param $type
 * @return string
 */

if ( ! function_exists('__checked_selected_helper')) {
    function __checked_selected_helper($helper, $current, $echo, $type){
        if ((string)$helper === (string)$current)
            $result = " $type='$type'";
        else
            $result = '';

        if ($echo)
            echo $result;

        return $result;
    }
}
/**
 * End Form Helper
 */



/**
 * Retrieve metadata from a video file's ID3 tags
 *
 * @since 3.6.0
 *
 * @param string $file Path to file.
 * @return array|bool Returns array of metadata, if found.
 */
function read_video_metadata( $file ) {
    if ( ! file_exists( $file ) ) {
        return false;
    }

    $metadata = array();

    if ( ! class_exists( 'getID3', false ) ) {
        require( app_path('ID3/getid3.php') );
    }

    $id3  = new getID3();
    $data = $id3->analyze( $file );

    if ( isset( $data['video']['lossless'] ) ) {
        $metadata['lossless'] = $data['video']['lossless'];
    }

    if ( ! empty( $data['video']['bitrate'] ) ) {
        $metadata['bitrate'] = (int) $data['video']['bitrate'];
    }

    if ( ! empty( $data['video']['bitrate_mode'] ) ) {
        $metadata['bitrate_mode'] = $data['video']['bitrate_mode'];
    }

    if ( ! empty( $data['filesize'] ) ) {
        $metadata['filesize'] = (int) $data['filesize'];
    }

    if ( ! empty( $data['mime_type'] ) ) {
        $metadata['mime_type'] = $data['mime_type'];
    }

    if ( ! empty( $data['playtime_seconds'] ) ) {
        $metadata['length'] = (int) round( $data['playtime_seconds'] );
    }

    if ( ! empty( $data['playtime_string'] ) ) {
        $metadata['length_formatted'] = $data['playtime_string'];
    }

    if ( ! empty( $data['video']['resolution_x'] ) ) {
        $metadata['width'] = (int) $data['video']['resolution_x'];
    }

    if ( ! empty( $data['video']['resolution_y'] ) ) {
        $metadata['height'] = (int) $data['video']['resolution_y'];
    }

    if ( ! empty( $data['fileformat'] ) ) {
        $metadata['fileformat'] = $data['fileformat'];
    }

    if ( ! empty( $data['video']['dataformat'] ) ) {
        $metadata['dataformat'] = $data['video']['dataformat'];
    }

    if ( ! empty( $data['video']['encoder'] ) ) {
        $metadata['encoder'] = $data['video']['encoder'];
    }

    if ( ! empty( $data['video']['codec'] ) ) {
        $metadata['codec'] = $data['video']['codec'];
    }

    if ( ! empty( $data['audio'] ) ) {
        unset( $data['audio']['streams'] );
        $metadata['audio'] = $data['audio'];
    }

    if ( empty( $metadata['created_timestamp'] ) ) {
        $created_timestamp = get_media_creation_timestamp( $data );

        if ( $created_timestamp !== false ) {
            $metadata['created_timestamp'] = $created_timestamp;
        }
    }

    $file_format = isset( $metadata['fileformat'] ) ? $metadata['fileformat'] : null;


    /**
     * Filters the array of metadata retrieved from a video.
     *
     * In core, usually this selection is what is stored.
     * More complete data can be parsed from the `$data` parameter.
     *
     *
     * @param array  $metadata       Filtered Video metadata.
     * @param string $file_format    File format of video, as analyzed by getID3.
     * @param string $data           Raw metadata from getID3.
     */

    return [
        'metadata'  => $metadata,
        'file_format'  => $file_format,
        'data'  => $data,
    ];
}


/**
 * Parse creation date from media metadata.
 *
 * The getID3 library doesn't have a standard method for getting creation dates,
 * so the location of this data can vary based on the MIME type.
 *
 *
 * @link https://github.com/JamesHeinrich/getID3/blob/master/structure.txt
 *
 * @param array $metadata The metadata returned by getID3::analyze().
 * @return int|bool A UNIX timestamp for the media's creation date if available
 *                  or a boolean FALSE if a timestamp could not be determined.
 */
function get_media_creation_timestamp( $metadata ) {
    $creation_date = false;

    if ( empty( $metadata['fileformat'] ) ) {
        return $creation_date;
    }

    switch ( $metadata['fileformat'] ) {
        case 'asf':
            if ( isset( $metadata['asf']['file_properties_object']['creation_date_unix'] ) ) {
                $creation_date = (int) $metadata['asf']['file_properties_object']['creation_date_unix'];
            }
            break;

        case 'matroska':
        case 'webm':
            if ( isset( $metadata['matroska']['comments']['creation_time']['0'] ) ) {
                $creation_date = strtotime( $metadata['matroska']['comments']['creation_time']['0'] );
            } elseif ( isset( $metadata['matroska']['info']['0']['DateUTC_unix'] ) ) {
                $creation_date = (int) $metadata['matroska']['info']['0']['DateUTC_unix'];
            }
            break;

        case 'quicktime':
        case 'mp4':
            if ( isset( $metadata['quicktime']['moov']['subatoms']['0']['creation_time_unix'] ) ) {
                $creation_date = (int) $metadata['quicktime']['moov']['subatoms']['0']['creation_time_unix'];
            }
            break;
    }

    return $creation_date;
}

if ( ! function_exists('icon_classes')) {
    function icon_classes(){
        $pattern = '/\.(la-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"\\\\(.+)";\s+}/';
        $subject = file_get_contents(ROOT_PATH . '/assets/css/line-awesome.css');
        preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $icons[$match[1]] = $match[2];
        }
        ksort($icons);
        return $icons;
    }
}

/**
 * @param int $level
 * @return array|mixed
 *
 * Course levels
 */

function course_levels($level = null){
    $levels = [
        1 => __t('beginner'),
        2 => __t('intermediate'),
        3 => __t('expert'),
        0 => __t('all_level'),
    ];

    if ($level !== null){
        $level = (int) $level;
        return array_get($levels, $level);
    }

    return apply_filters('course_levels', $levels);
}

function seconds_to_time_format($seconds = 0){
    if ( ! $seconds){
        return "00:00";
    }

    $hours = floor($seconds / 3600);
    $mins = floor(($seconds - $hours*3600) / 60);
    $s = $seconds - ($hours*3600 + $mins*60);

    $mins = ($mins<10?"0".$mins:"".$mins);
    $s = ($s<10?"0".$s:"".$s);

    $time = ($hours>0?$hours.":":"").$mins.":".$s;
    return $time;
}


if ( ! function_exists('cart')) {
    /**
     * @param int $course_id
     * @return array|mixed|null
     */

    function cart($course_id = 0){
        //session()->forget('cart');
        $data = (array) session('cart');

        if ($course_id) {
            return array_get($data, $course_id);
        }

        $total_price = array_sum(array_column(array_values($data), 'price'));
        $data = [
            'courses' => $data,
            'total_price' => $total_price,
            'total_original_price' => array_sum(array_column(array_values($data), 'original_price')),
            'count' => count($data),
            'enable_charge_fees'    => false,
        ];

        $fees_total = 0;

        $enable_charge_fees = (bool) get_option('enable_charge_fees');
        if ($enable_charge_fees){
            $fees_type = get_option('charge_fees_type');
            $fees_amount = get_option('charge_fees_amount');

            $data['enable_charge_fees'] = true;
            $data['fees_name'] = get_option('charge_fees_name');
            $data['fees_amount'] = $fees_amount;
            $data['fees_type'] = $fees_type;

            if ($fees_type === 'percent'){
                $fees_total = ($total_price * $fees_amount) / 100;
            }
            $data['fees_total'] = $fees_total;
        }

        $data['total_amount'] = $total_price + $fees_total;


        return (object) $data;
    }
}



/**
 * @param string $type
 * @return string
 *
 * @return stripe secret key or test key
 */

function get_stripe_key($type = 'publishable'){
    $stripe_key = '';

    if ($type == 'publishable'){
        if (get_option('stripe_test_mode') == 1){
            $stripe_key = get_option('stripe_test_publishable_key');
        }else{
            $stripe_key = get_option('stripe_live_publishable_key');
        }
    }elseif ($type == 'secret'){
        if (get_option('stripe_test_mode') == 1){
            $stripe_key = get_option('stripe_test_secret_key');
        }else{
            $stripe_key = get_option('stripe_live_secret_key');
        }
    }

    return $stripe_key;
}

/**
 * @param $user
 * @param $course_id
 *
 * Make enroll student to a course
 */

function do_enroll($user_id, $course_id, $course_price, $payment_id = 0){
    $carbon = Carbon::now()->toDateTimeString();

    $data = [
        'course_id'     => $course_id,
        'user_id'       => $user_id,
        'course_price'  => $course_price,
        'payment_id'    => $payment_id,
        'status'        => 'success',
        'enrolled_at'   => $carbon
    ];

    DB::table('enrolls')->insert($data);
    do_action('do_enroll', $data);
}

if ( ! function_exists('complete_content')) {
    function complete_content( $content, $user, $scope = 'complete' ) {
        if ( ! $content || ! $user ) {
            return false;
        }

        if ( ! $content instanceof Content ) {
            $content = Content::find( $content );
        }
        if ( ! $user instanceof \App\User ) {
            $user = \App\User::find( $user );
        }

        $course_id = $content->course_id;

        $is_completed = Complete::whereContentId( $content->id )->whereUserId( $user->id )->first();

        if ( ! $is_completed ) {
            $data = [
                'user_id'      => $user->id,
                'course_id'    => $course_id,
                'content_id'   => $content->id,
                'completed_at' => Carbon::now()->toDateTimeString(),
            ];

            $complete = Complete::create( $data );

            do_action( 'complete_course', $complete );
        } else {
            if ( $scope === 'delete' ) {
                $is_completed->delete();
            }
        }

        $total_contents  = (int) Content::whereCourseId( $course_id )->count();
        $completes       = Complete::whereUserId( $user->id )->whereCourseId( $course_id )->pluck( 'content_id' );
        $completed_count = $completes->count();
        $percent         = 0;
        if ( $total_contents && $completed_count ) {
            $percent = (int) number_format( ( $completed_count * 100 ) / $total_contents );
        }

        $completed_courses                          = (array) $user->get_option( 'completed_courses' );
        $completed_courses[ $course_id ]['percent'] = $percent;

        //Save Array Unique
        $content_ids   = $completes->toArray();
        $content_ids[] = $content->id;
        $content_ids   = array_unique( $content_ids );

        if ( $scope === 'delete' ) {
            if ( ( $key = array_search( $content->id, $content_ids ) ) !== false ) {
                unset( $content_ids[ $key ] );
            }
        }

        $completed_courses[ $course_id ]['content_ids'] = $content_ids;

        $user->update_option( 'completed_courses', $completed_courses );
    }
}

/**
 * @param string $name
 * @param string $label
 * @param string $old_value
 */
function switch_field($name = '', $label = '', $old_value = ''){
    $field_html = "<div class='switch-button-wrapper d-flex pt-2'>
        <label class='switch mr-2'>
            <input type='checkbox' value='1' id='{$name}' name='{$name}' ".checked(1, $old_value, false)." />
            <span class='slider round'></span>
        </label>
        <label for='{$name}' style='margin-left: 35px;' >{$label}</label>
    </div>";
    ?>
    <?php
    return $field_html;
}

/**
 * @param $course
 * @return string
 *
 * Course Card, this will be use to all place where required to show the cards.
 */
if ( ! function_exists('course_card')) {
    function course_card($course, $grid_class = null){
        return view_template_part('template-part.course-loop', compact('course', 'grid_class'));
    }
}

if (! function_exists('countries')) {
    function countries($country_id = null){
        if (!$country_id) {
            $countries = \App\Country::query()->orderBy('name', 'ASC')->get();
            return $countries;
        }

        return \App\Country::find($country_id);
    }
}

/**
 * @param float $current_rating
 * @param bool $echo
 * @return string
 *
 *
 * Generate Star Rating...
 */

if ( ! function_exists('star_rating_field')) {
    function star_rating_field($current_rating = 0.00, $echo = false){
        $output = '<div class="review-write-star-wrap mb-3">';
        $output .= star_rating_generator($current_rating);
        $output .= "<input type='hidden' name='rating_value' value='{$current_rating}'>";
        $output .= "</div>";

        if ($echo) {
            echo $output;
        }
        return $output;
    }
}

if ( ! function_exists('star_rating_generator')) {
    function star_rating_generator($current_rating = 0.00){
        $output = '<div class="generated-star-rating-wrap">';

        for ($i = 1; $i <= 5; $i++) {
            $intRating = (int)$current_rating;

            if ($intRating >= $i) {
                $output .= '<i class="la la-star" data-rating-value="' . $i . '"></i>';
            } else {
                $fraction = 1 - ($i - $current_rating);
                if ($fraction > 0.69) {
                    $output .= '<i class="la la-star" data-rating-value="' . $i . '"></i>';
                } elseif ($fraction > 0.39) {
                    $output .= '<i class="la la-star-half-alt" data-rating-value="' . $i . '"></i>';
                } else {
                    $output .= '<i class="la la-star-o" data-rating-value="' . $i . '"></i>';
                }
            }
        }
        $output .= "</div>";
        return $output;
    }
}

if ( ! function_exists('has_review')) {
    function has_review($user_id = null, $course_id = null){
        return Review::whereUserId($user_id)->whereCourseId($course_id)->first();
    }
}

/**
 * @param string $title
 * @param string $desc
 * @param string $class
 * @return string
 *
 * return no data found predefined template
 */
if (! function_exists('no_data')) {
    function no_data($title = '', $desc = '', $class = null){
        $title = $title ? $title : __a('nothing_here');
        $desc = $desc ? $desc : __a('nothing_here_desc');
        $class = $class ? $class : 'my-4 pb-4';
        $no_data_img = asset('assets/images/no-data.svg');

        $output = " <div class='no-data-screen-wrap text-center {$class} '>
            <img src='{$no_data_img}' style='max-height: 250px; width: auto' />
            <h3 class='no-data-title'>{$title}</h3>
            <h5 class='no-data-subtitle'>{$desc}</h5>
        </div>";
        return $output;
    }
}

if ( ! function_exists('withdraw_methods')) {
    function withdraw_methods(){
        $admin = (Auth::user() && Auth::user()->isAdmin()) ? true : false;
        $methods = [
            'bank_transfer' => [
                'method_name' => 'Bank Transfer',
                'desc' => __t('bank_transfer_desc'),
                'admin_form_fields' => [
                    'notes' => [
                        'type' => 'textarea',
                        'label' => 'Notes',
                        'desc' => ($admin) ? __a('bank_transfer_notes_desc') : __t('bank_transfer_notes_desc'),
                    ],
                ],

                'form_fields' => [
                    'account_name' => [
                        'type' => 'text',
                        'label' => ($admin) ? __a('account_name') : __t('account_name'),
                    ],

                    'account_number' => [
                        'type' => 'text',
                        'label' => ($admin) ? __a('account_number') : __t('account_number'),
                    ],

                    'bank_name' => [
                        'type' => 'text',
                        'label' => ($admin) ? __a('bank_name') : __t('bank_name'),
                    ],
                    'iban' => [
                        'type' => 'text',
                        'label' => ($admin) ? __a('iban') : __t('iban'),
                    ],
                    'swift' => [
                        'type' => 'text',
                        'label' => ($admin) ? __a('bic_swift') : __t('bic_swift'),
                    ],

                ],
            ],

            'echeck' => [
                'method_name' => 'E-Check',
                'form_fields' => [
                    'physical_address' => [
                        'type' => 'textarea',
                        'label' => ($admin) ? __a('ur_physical_address') : __t('ur_physical_address'),
                        'desc' => ($admin) ? __a('echeck_desc') : __t('echeck_desc'),
                    ],
                ],
            ],

            'paypal' => [
                'method_name' => 'PayPal',
                'form_fields' => [
                    'paypal_email' => [
                        'type' => 'email',
                        'label' => ($admin) ? __a('paypal_email') : __t('paypal_email'),
                        'desc' => ($admin) ? __a('paypal_desc') : __t('paypal_desc'),
                    ],

                ],
            ],

        ];

        return apply_filters('withdraw_methods', $methods);
    }
}

if ( ! function_exists('active_withdraw_methods')) {
    function active_withdraw_methods($method_key = null){
        $methods = withdraw_methods();

        foreach ($methods as $key => $method) {
            if (!get_option("withdraw_methods.{$key}.enable")) {
                unset($methods[$key]);
            }
        }
        if ($method_key){
            return array_get($methods, $method_key);
        }

        return $methods;
    }
}

/**
 * @param null $type
 * @return array|mixed
 */
if ( ! function_exists('question_types')){
    function question_types($type = null){
        $types = [
            'radio' => __t('single_choice'),
            'checkbox' => __t('multiple_choice'),
            'text' => __t('single_line_text'),
            'textarea' => __t('multi_line_text'),
        ];

        if ($type){
            return array_get($types, $type);
        }

        return apply_filters('questions_types', $types);
    }
}
/**
 * @param $value
 * @param array $protocols
 * @param array $attributes
 * @return string|string[]|null
 *
 * Turning link from string to actual clickable link
 */

if ( ! function_exists('linkify')) {
    function linkify($value, $protocols = array('http', 'mail'), array $attributes = array()){
        // Link attributes
        $attr = '';
        foreach ($attributes as $key => $val) {
            $attr .= ' ' . $key . '="' . htmlentities($val) . '"';
        }

        $links = array();

        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) {
            return '<' . array_push($links, $match[1]) . '>';
        }, $value);

        // Extract text links for each protocol
        foreach ((array)$protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':
                    $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                        if ($match[1]) $protocol = $match[1];
                        $link = $match[2] ?: $match[3];
                        return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>';
                    }, $value);
                    break;
                case 'mail':
                    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) {
                        return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>';
                    }, $value);
                    break;
                case 'twitter':
                    $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) {
                        return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1] . "\">{$match[0]}</a>") . '>';
                    }, $value);
                    break;
                default:
                    $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                        return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>';
                    }, $value);
                    break;
            }
        }

        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) {
            return $links[$match[1] - 1];
        }, $value);
    }
}

/**
 * @param $route
 * @return mixed
 *
 * Check if route exists
 */
if ( ! function_exists('route_has')) {
    function route_has($route){
        return \Illuminate\Support\Facades\Route::has($route);
    }
}

/**
 * @param null $basename
 * @return bool|null
 *
 * Check if given plugin is activated
 */
if ( function_exists('plugin_activated')) {
    function plugin_activated($basename = null){
        if ($basename) {
            $active_plugins = (array) json_decode(get_option('active_plugins'), true);
            return in_array($basename, $active_plugins);
        }
        return null;
    }
}

if ( ! function_exists('get_pages')) {
    function get_pages(){
        $posts = Post::whereType('page')->orderBy('title', 'asc')->get();
        return $posts;
    }
}

if ( ! function_exists('cookie_message_html')) {
    function cookie_message_html(){
        $msg = get_option('cookie_alert.message');

        $link = "<a href='" . route('post_proxy', get_option('privacy_policy_page')) . "'>" . __t('read_privacy_policy') . "</a>";
        $msg = str_replace('{privacy_policy_url}', $link, $msg);

        return '
        <div class="row m-0 pb-5 pb-lg-0 justify-content-center">
        <div class="col-sm-11 pl-lg-4">
        <div class="cookie_notice_popup">
        <div class="cookie_notice_msg">'.$msg.'</div>
        <a href="" class="cookie-dismiss">Ok</a>
        </div>
        </div>
        </div>';
    }
}

if ( ! function_exists('clean_html')){
    function clean_html($text = null){
        if ($text){
            $text = strip_tags($text, '<h1><h2><h3><h4><h5><h6><p><br><ul><li><hr><a><abbr><address><b><blockquote><center><cite><code><del><i><ins><strong><sub><sup><time><u><img><iframe><link><nav><ol><table><caption><th><tr><td><thead><tbody><tfoot><col><colgroup><div><span>');

            $text = str_replace('javascript:', '', $text);
        }
        return $text;
    }
}

if ( ! function_exists('live_env')){
    function is_live_env(){
        if(env('APP_ENV')=='live') {
            return true;
        }
        return false;
    }
}

if (!function_exists('protectedString')) {
    
    function protectedString($str) {
        if(is_live_env()) {
            return substr($str, 0, 1) . '****' . substr($str,  -4);
        }
        return $str;
    }
}

if (!function_exists('labelHtml')) {
    
    function labelHtml($course_id) {
        $labels = Labels::orderBy('order', 'asc')->get();
        if($labels) {

            $course     = Course::find($course_id);

            $now        = time();
            $datediff   = $now - strtotime($course->created_at);
            $daysDiff   = intval( round($datediff / (60 * 60 * 24)) );

            foreach($labels as $label) {

                $number_of_days_from_arrived    = $label->number_of_days_from_arrived;
                $number_of_recent_days          = $label->number_of_recent_days;
                $number_of_sales                = $label->number_of_sales;
                $min_ratings_count              = $label->min_ratings_count;
                $min_avg_ratings                = $label->min_avg_ratings;

                $current_label = "<span class='badge badge-custom' style='color: #fff; background-color: ".$label->label_color."'>".$label->label_name."</span>";

                if( ($number_of_days_from_arrived=='' || $number_of_days_from_arrived==0) && ($number_of_recent_days=='' || $number_of_recent_days==0) && ($number_of_sales=='' || $number_of_sales==0) && ($min_ratings_count=='' || $min_ratings_count==0) && ($min_avg_ratings=='' || $min_avg_ratings=='0.0') ) {

                    // 
                    // return current label if criteria matching
                    return $current_label;

                } else {

                    $number_of_days_from_arrived    = ($number_of_days_from_arrived=='') ? 0 : $number_of_days_from_arrived;
                    $number_of_recent_days          = ($number_of_recent_days=='') ? 0 : $number_of_recent_days;
                    $number_of_sales                = ($number_of_sales=='') ? 0 : $number_of_sales;
                    $min_ratings_count              = ($min_ratings_count=='') ? 0 : $min_ratings_count;
                    $min_avg_ratings                = ($min_avg_ratings=='') ? 0 : $min_avg_ratings;

                    if($daysDiff < $number_of_days_from_arrived) {

                        $recent_sales = \App\Enroll::where('course_id', $course_id)->whereRaw( "enrolled_at >= ( CURDATE() - INTERVAL ". $number_of_recent_days ." DAY )" )->count();

                        if($recent_sales >= $number_of_sales) {

                            $recent_ratings = \App\Review::select('*')->where('course_id', $course_id)->whereRaw( "updated_at >= ( CURDATE() - INTERVAL ". $number_of_recent_days ." DAY )" )->get();

                            if($recent_ratings->count() >= $min_ratings_count) {

                                if($recent_ratings->avg('rating') >= $min_avg_ratings) {

                                    // 
                                    // return current label if criteria matching
                                    return $current_label;
                                }

                            }

                        }

                    } else {

                        if($number_of_recent_days==0 && $number_of_sales==0 && $min_ratings_count==0 && $min_avg_ratings==0) {
                            return '';
                        }


                        $recent_sales = \App\Enroll::where('course_id', $course_id)->whereRaw( "enrolled_at >= ( CURDATE() - INTERVAL ". $number_of_recent_days ." DAY )" )->get();
                        // dd('course id - '.$course_id, 'number_of_days_from_arrived - '.$number_of_days_from_arrived, 'daysDiff - '.$daysDiff, 'recent_sales - '.$recent_sales);

                        if($recent_sales->count() >= $number_of_sales) {


                            if($recent_sales->count() == 0) {
                                $recent_ratings = \App\Review::select('*')->where('course_id', $course_id)->get();

                                // dd('course id - '.$course_id, 'number_of_days_from_arrived - '.$number_of_days_from_arrived, 'daysDiff - '.$daysDiff, 'recent_ratings - '.$recent_ratings);

                                if($recent_ratings->count() >= $min_ratings_count) {

                                    if($recent_ratings->count() > 0) {
                                        
                                        if($recent_ratings->avg('rating') >= $min_avg_ratings) {
                                            // 
                                            // return current label if criteria matching
                                            return $current_label;
                                        }
                                    }

                                } else {
                                    
                                    if($recent_ratings->count() > $min_ratings_count) {
                                        if($recent_ratings->avg('rating') >= $min_avg_ratings) {
                                            // 
                                            // return current label if criteria matching
                                            return $current_label;
                                        }
                                    }
                                }
                            }

                            $recent_ratings = \App\Review::select('*')->where('course_id', $course_id)->whereRaw( "updated_at >= ( CURDATE() - INTERVAL ". $number_of_recent_days ." DAY )" )->get();

                            if($recent_ratings->count() >= $min_ratings_count) {

                                if($recent_ratings->avg('rating') >= $min_avg_ratings) {
                                    // 
                                    // return current label if criteria matching
                                    return $current_label;
                                }

                            }

                        }

                    }


                }

            }

        } else {
            return '';
        }

    }

}
