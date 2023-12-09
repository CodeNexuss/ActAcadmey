<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = array(
            array('id' => '1','option_key' => 'default_storage','option_value' => 'public'),
            array('id' => '2','option_key' => 'date_format','option_value' => 'd/m/Y'),
            array('id' => '3','option_key' => 'time_format','option_value' => 'H:i'),
            array('id' => '4','option_key' => 'site_name','option_value' => 'Udify'),
            array('id' => '5','option_key' => 'site_title','option_value' => 'Udify'),
            array('id' => '6','option_key' => 'email_address','option_value' => 'udify@gmail.com'),
            array('id' => '7','option_key' => 'default_timezone','option_value' => 'Asia/Dhaka'),
            array('id' => '8','option_key' => 'date_format_custom','option_value' => 'd/m/Y'),
            array('id' => '9','option_key' => 'time_format_custom','option_value' => 'H:i'),
            array('id' => '10','option_key' => 'enable_stripe','option_value' => '1'),
            array('id' => '11','option_key' => 'stripe_test_mode','option_value' => '1'),
            array('id' => '12','option_key' => 'paypal_receiver_email','option_value' => 'MerchantKennethNBoyd@teleworm.us'),
            array('id' => '13','option_key' => 'stripe_test_secret_key','option_value' => 'sk_test_tJeAdA1KbhiYV8I8bfPmJcOL'),
            array('id' => '14','option_key' => 'stripe_test_publishable_key','option_value' => 'pk_test_P3TFmKrvT7l29Zpyy1f4pwk8'),
            array('id' => '15','option_key' => 'stripe_live_secret_key','option_value' => NULL),
            array('id' => '16','option_key' => 'stripe_live_publishable_key','option_value' => NULL),
            array('id' => '17','option_key' => 'enable_paypal','option_value' => '1'),
            array('id' => '18','option_key' => 'enable_paypal_sandbox','option_value' => '1'),
            array('id' => '19','option_key' => 'current_theme','option_value' => 'bluetheme'),
            array('id' => '20','option_key' => 'copyright_text','option_value' => '[copyright_sign] [year] [site_name], All rights reserved.'),
            array('id' => '21','option_key' => 'enable_social_login','option_value' => '1'),
            array('id' => '22','option_key' => 'enable_facebook_login','option_value' => '1'),
            array('id' => '23','option_key' => 'enable_google_login','option_value' => '1'),
            array('id' => '24','option_key' => 'fb_app_id','option_value' => '489217706209809'),
            array('id' => '25','option_key' => 'fb_app_secret','option_value' => 'a256f536ef0778fb6da4957c416555e7'),
            array('id' => '26','option_key' => 'google_client_id','option_value' => '944325701466-j93lsd9vaar1ddmvgtrrpbpft1b5596i.apps.googleusercontent.com'),
            array('id' => '27','option_key' => 'google_client_secret','option_value' => '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'),
            array('id' => '28','option_key' => 'currency_position','option_value' => 'left'),
            array('id' => '29','option_key' => 'currency_sign','option_value' => 'USD'),
            array('id' => '30','option_key' => 'payment_gateway_direct-bank-transfer','option_value' => '{"enabled":"0","title":"Direct Bank Transfer","description":"Pay via direct bank transfer to process your order","instructions":"Please transfer your fund using following Bank Account\\r\\n\\r\\nBank Name: Bank Asia\\r\\nBranch: Mirpur circle 10\\r\\nA\\/C No: 079878765545354","gateway_save_btn":null}'),
            array('id' => '31','option_key' => 'payment_gateway_cod','option_value' => '{"enabled":"0","title":"Cash on delivery","description":"Pay upon delivery","instructions":"Pay upon delivery to the delivery man","gateway_save_btn":null}'),
            array('id' => '32','option_key' => 'allowed_file_types','option_value' => 'jpeg,png,jpg,pdf,zip,doc,docx,xls,ppt,mp4,webp,avif'),
            array('id' => '33','option_key' => 'is_preview','option_value' => '1'),
            array('id' => '34','option_key' => 'admin_share','option_value' => '20'),
            array('id' => '35','option_key' => 'instructor_share','option_value' => '80'),
            array('id' => '36','option_key' => 'charge_fees_name','option_value' => 'Payment gateway charge'),
            array('id' => '37','option_key' => 'charge_fees_amount','option_value' => '4'),
            array('id' => '38','option_key' => 'charge_fees_type','option_value' => 'percent'),
            array('id' => '39','option_key' => 'enable_charge_fees','option_value' => '1'),
            array('id' => '40','option_key' => 'enable_instructors_earning','option_value' => '1'),
            array('id' => '41','option_key' => 'bank_gateway','option_value' => 'json_encode_value_{"enable_bank_transfer":"0"}'),
            array('id' => '42','option_key' => 'enable_offline_payment','option_value' => '0'),
            array('id' => '43','option_key' => 'site_url','option_value' => 'https://udify.trioangledemo.com'),
            array('id' => '44','option_key' => 'withdraw_methods','option_value' => 'json_encode_value_{"bank_transfer":{"enable":"0","min_withdraw_amount":"100","notes":"Please note that it takes approximately 2 to 7 days to process your withdraw via bank transfer. Sometimes it may take longer. If you do not receive withdrawal after 7 days, please contact our customer support. Updated"},"echeck":{"enable":"0","min_withdraw_amount":"50"},"paypal":{"enable":"1","min_withdraw_amount":"50"}}'),
            array('id' => '45','option_key' => 'lms_settings','option_value' => 'json_encode_value_{"enable_discussion":"1","instructor_can_publish_course":"1"}'),
            array('id' => '46','option_key' => 'active_plugins','option_value' => '{"3":"StudentsProgress","4":"Certificate"}'),
            array('id' => '47','option_key' => 'site_logo','option_value' => '246'),
            array('id' => '48','option_key' => 'terms_of_use_page','option_value' => 3),
            array('id' => '49','option_key' => 'privacy_policy_page','option_value' => 2),
            array('id' => '50','option_key' => 'about_us_page','option_value' => 1),
            array('id' => '51','option_key' => 'cookie_alert','option_value' => 'json_encode_value_{"enable":"1","message":"By using Udify you accept our cookies and agree to our privacy policy, including cookie policy. {privacy_policy_url}"}'),
            array('id' => '52','option_key' => 'social_login','option_value' => 'json_encode_value_{"facebook":{"enable":"1","app_id":"489217706209809","app_secret":"a256f536ef0778fb6da4957c416555e7"},"google":{"enable":"1","client_id":"944325701466-j93lsd9vaar1ddmvgtrrpbpft1b5596i.apps.googleusercontent.com","client_secret":"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"},"twitter":{"enable":"1","consumer_key":"iXy8T2reBWP42aD60rXdtUf8R","consumer_secret":"SEYSr2AFVaVfH56xPZerEZxBW7gGgZOE2CT8jdoq32BbuL7Zv3"},"linkedin":{"enable":"1","client_id":"78a3zs0vconbmx","client_secret":"3p2a4HF5ZO6eWJOQ"}}'),
            array('id' => '53','option_key' => 'facebook_joinus_link','option_value' => "https://www.example.com"),
            array('id' => '54','option_key' => 'twitter_joinus_link','option_value' => "https://www.example.com"),
            array('id' => '55','option_key' => 'youtube_joinus_link','option_value' => "https://www.example.com"),
            array('id' => '56','option_key' => 'copyright_year','option_value' => date('Y')),
            array('id' => '57','option_key' => 'copyright_url','option_value' => url('/')),
            array('id' => '58','option_key' => 'copyright_name','option_value' => 'Trioangle'),
            array('id' => '59','option_key' => 'about_us_content','option_value' => 'Udify platform that connect Teachers with Students globally. Teachers create high quality course and present them in super easy way.'),
            array('id' => '60','option_key' => 'site_address','option_value' => "No 12/9, Santhosh Raj Plaza, 3rd Floor, Subburaman Street, Gandhi Nagar, Madurai - 625020, Tamil Nadu, India."),
            array('id' => '61','option_key' => 'site_phone_number','option_value' => '0123456789'),
            array('id' => '62','option_key' => 'site_email','option_value' => 'udify@gmail.com'),
            array('id' => '63','option_key' => 'site_favicon','option_value' => '246'),
            array('id' => '64','option_key' => 'site_email_logo','option_value' => '246'),
            array('id' => '65','option_key' => 'enable_telebirr','option_value' => '1'),

        );

        \Illuminate\Support\Facades\DB::table('options')->insert($options);
    }
}
