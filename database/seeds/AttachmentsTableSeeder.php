<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachments = array(
            array('id' => '1','course_id' => NULL,'belongs_course_id' => '1','assignment_submission_id' => NULL,'content_id' => '3','user_id' => '2','media_id' => '2','hash_id' => 'jqcmdscogfsbo158107zpzf81eqn2vuh'),
            array('id' => '2','course_id' => NULL,'belongs_course_id' => '1','assignment_submission_id' => NULL,'content_id' => '8','user_id' => '2','media_id' => '3','hash_id' => 'paptmrto9aqnd158394nxnheila1xpk0'),
            array('id' => '4','course_id' => NULL,'belongs_course_id' => '1','assignment_submission_id' => NULL,'content_id' => '9','user_id' => '2','media_id' => '4','hash_id' => 'xqebcc9fuv5o9159049kovytnz4vnkbv'),
            array('id' => '5','course_id' => NULL,'belongs_course_id' => '1','assignment_submission_id' => NULL,'content_id' => '9','user_id' => '2','media_id' => '5','hash_id' => '0lxejhaeng4lg159073i38xjmwnrw8rt'),
            array('id' => '6','course_id' => NULL,'belongs_course_id' => '1','assignment_submission_id' => NULL,'content_id' => '11','user_id' => '2','media_id' => '6','hash_id' => 'rw4nuz45ytdnf160042a2eqj33nhr3lh'),
            array('id' => '7','course_id' => NULL,'belongs_course_id' => '2','assignment_submission_id' => NULL,'content_id' => '12','user_id' => '5','media_id' => '9','hash_id' => 'krwxy8khkd5np182669mvhvnnegtwsbo'),
            array('id' => '8','course_id' => NULL,'belongs_course_id' => '2','assignment_submission_id' => NULL,'content_id' => '12','user_id' => '5','media_id' => '8','hash_id' => 'bc75qn0c5cvj0182669lridqwhibvz4g'),
            array('id' => '9','course_id' => NULL,'belongs_course_id' => '2','assignment_submission_id' => NULL,'content_id' => '15','user_id' => '5','media_id' => '10','hash_id' => 'bap2rlzqzm65k183729jdbgcd34r61wy'),
            array('id' => '10','course_id' => NULL,'belongs_course_id' => '2','assignment_submission_id' => NULL,'content_id' => '18','user_id' => '5','media_id' => '11','hash_id' => 'wzmfcsbqbizp2184340suoltxohaxkgb'),
            array('id' => '11','course_id' => NULL,'belongs_course_id' => '3','assignment_submission_id' => NULL,'content_id' => '19','user_id' => '6','media_id' => '12','hash_id' => 'x6bk0egw4s7fm184998eajymtfjg0quf'),
            array('id' => '12','course_id' => NULL,'belongs_course_id' => '3','assignment_submission_id' => NULL,'content_id' => '21','user_id' => '6','media_id' => '13','hash_id' => 'l8kstrxvlq350185206b3kutptx9oq3k'),
            array('id' => '13','course_id' => NULL,'belongs_course_id' => '3','assignment_submission_id' => NULL,'content_id' => '22','user_id' => '6','media_id' => '14','hash_id' => 'edg1hdziqnmhj233108dgzsjqgxfhmv8'),
            array('id' => '14','course_id' => NULL,'belongs_course_id' => '3','assignment_submission_id' => NULL,'content_id' => '24','user_id' => '6','media_id' => '14','hash_id' => '4yyxursxvwjtz238305jfj4quapb84fh'),
            array('id' => '15','course_id' => NULL,'belongs_course_id' => '2','assignment_submission_id' => NULL,'content_id' => '16','user_id' => '5','media_id' => '21','hash_id' => 'chxiweymtp8nx241459qdyxf3pjye05o'),
            array('id' => '16','course_id' => NULL,'belongs_course_id' => '8','assignment_submission_id' => NULL,'content_id' => '40','user_id' => '2','media_id' => '27','hash_id' => 't5koyznpjwdfs244833h5wb4v5mjrhka'),
            array('id' => '17','course_id' => NULL,'belongs_course_id' => '8','assignment_submission_id' => NULL,'content_id' => '41','user_id' => '2','media_id' => '27','hash_id' => 'yem85nuc4dhjb245157puzvf3upubclb'),
            array('id' => '18','course_id' => NULL,'belongs_course_id' => '8','assignment_submission_id' => NULL,'content_id' => '45','user_id' => '2','media_id' => '28','hash_id' => '0cr1ymag4n9xd245599eyr0lnh6sf8uv'),
            array('id' => '19','course_id' => NULL,'belongs_course_id' => NULL,'assignment_submission_id' => '2','content_id' => NULL,'user_id' => '8','media_id' => '30','hash_id' => '7zdq4oad4eyxl251364jyhp6szgcsr8z'),
            array('id' => '20','course_id' => NULL,'belongs_course_id' => NULL,'assignment_submission_id' => '1','content_id' => NULL,'user_id' => '8','media_id' => '30','hash_id' => 'catdozpe1dpvi251447xrszbwp7ffzxb'),
            array('id' => '21','course_id' => NULL,'belongs_course_id' => NULL,'assignment_submission_id' => '3','content_id' => NULL,'user_id' => '8','media_id' => '30','hash_id' => 'dfrxbigzpjaj3252579zi1hxto7taox0'),
            array('id' => '22','course_id' => NULL,'belongs_course_id' => '10','assignment_submission_id' => NULL,'content_id' => '60','user_id' => '2','media_id' => '32','hash_id' => 'w5mgmambcsxcb256373uunlti7i9z8sc'),
            array('id' => '23','course_id' => NULL,'belongs_course_id' => '24','assignment_submission_id' => NULL,'content_id' => '65','user_id' => '1','media_id' => '33','hash_id' => '6ielcwc1yvdfi322477oep7xshxruabg'),
            array('id' => '24','course_id' => NULL,'belongs_course_id' => '10','assignment_submission_id' => NULL,'content_id' => '135','user_id' => '2','media_id' => '244','hash_id' => 'qoibnf1tgvuil763010uu85edcnv8fev')
        );
        
        \Illuminate\Support\Facades\DB::table('attachments')->insert(
            $attachments
        );
    }
}
