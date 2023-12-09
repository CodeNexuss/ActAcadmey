<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = array(
            array('id' => '2','course_id' => '1','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '3','course_id' => '1','section_name' => 'Android Development Environment','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '1'),
            array('id' => '4','course_id' => '2','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '6','course_id' => '2','section_name' => 'Machine Learning Techniques','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '7','course_id' => '3','section_name' => 'AWS-Infrastructure','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '8','course_id' => '3','section_name' => 'AWS-IOT','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '9','course_id' => '6','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '10','course_id' => '6','section_name' => 'Understanding Hardware','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '11','course_id' => '6','section_name' => 'Basics of networking','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '13','course_id' => '6','section_name' => 'Understanding Operating Systems','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '15','course_id' => '6','section_name' => 'Conclusion and Goodbye','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '16','course_id' => '7','section_name' => 'Machine Learning Quiz','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '17','course_id' => '8','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '18','course_id' => '8','section_name' => 'Advertising','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '19','course_id' => '8','section_name' => 'Selling products','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '20','course_id' => '8','section_name' => 'Promoting products','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '21','course_id' => '8','section_name' => 'Conclusion','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '22','course_id' => '9','section_name' => 'Framework','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '23','course_id' => '9','section_name' => 'Specific Steps To Becoming More Productive','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '24','course_id' => '9','section_name' => 'Next','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '25','course_id' => '10','section_name' => 'Introduction and setup','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '26','course_id' => '10','section_name' => 'Introduction to Querying','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '27','course_id' => '10','section_name' => 'SQL Joins','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '29','course_id' => '24','section_name' => 'tgrghr','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '31','course_id' => '11','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '32','course_id' => '11','section_name' => 'OOPs','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '33','course_id' => '12','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '34','course_id' => '12','section_name' => 'Introduction of hacking and security','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '35','course_id' => '12','section_name' => 'Malwares','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '36','course_id' => '12','section_name' => 'Hacking','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '37','course_id' => '13','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '38','course_id' => '13','section_name' => 'Numpy','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '39','course_id' => '14','section_name' => 'The Elite Writer\'s Journey','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '40','course_id' => '18','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '41','course_id' => '17','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '42','course_id' => '17','section_name' => 'Languages','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '43','course_id' => '16','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '44','course_id' => '16','section_name' => 'React JS','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '45','course_id' => '15','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '46','course_id' => '15','section_name' => 'Basic HTML','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '47','course_id' => '15','section_name' => 'CSS basics','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '48','course_id' => '23','section_name' => 'Introduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '49','course_id' => '23','section_name' => 'Evolution of Currency','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '50','course_id' => '23','section_name' => 'Blockchain','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '51','course_id' => '22','section_name' => 'Indroduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '52','course_id' => '22','section_name' => 'Before You Get the Interview','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '53','course_id' => '22','section_name' => 'During the Interview','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '54','course_id' => '21','section_name' => 'Indroduction','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '55','course_id' => '21','section_name' => 'How to Use Technical Analysis in Trading','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '56','course_id' => '20','section_name' => 'PHOTOGRAPHY','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '57','course_id' => '19','section_name' => 'Introduction To the Practice','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '58','course_id' => '19','section_name' => 'Power of the Word','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '1'),
            array('id' => '59','course_id' => '19','section_name' => 'Power of the Heart','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '2'),
            array('id' => '60','course_id' => '19','section_name' => 'Healing Resentment','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '3'),
            array('id' => '61','course_id' => '19','section_name' => 'Overcoming Fear','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '4'),
            array('id' => '62','course_id' => '19','section_name' => 'Healing the Block to Happiness','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '5'),
            array('id' => '63','course_id' => '10','section_name' => 'Quiz & Assignment','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '64','course_id' => '14','section_name' => 'Assignment','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0'),
            array('id' => '65','course_id' => '13','section_name' => 'Quiz & Assignment','unlock_date' => NULL,'unlock_days' => NULL,'sort_order' => '0')
        );

        \Illuminate\Support\Facades\DB::table('sections')->insert(
            $sections
        );
    }
}
