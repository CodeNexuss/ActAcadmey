<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = array(
            array('id' => '1','user_id' => '2','quiz_id' => '4','title' => 'Mobile Computing Means','image_id' => '15','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '2','user_id' => '2','quiz_id' => '5','title' => 'What is Mobile Computing?','image_id' => NULL,'type' => 'checkbox','score' => NULL,'sort_order' => '1'),
            array('id' => '3','user_id' => '2','quiz_id' => '5','title' => 'How Many Concepts in Mobile Computing?','image_id' => NULL,'type' => 'checkbox','score' => NULL,'sort_order' => '2'),
            array('id' => '4','user_id' => '2','quiz_id' => '5','title' => 'Mobile Software Helps for','image_id' => NULL,'type' => 'checkbox','score' => NULL,'sort_order' => '3'),
            array('id' => '5','user_id' => '2','quiz_id' => '5','title' => 'What is the top-most Essential Module in the Mobile Computing','image_id' => NULL,'type' => 'checkbox','score' => NULL,'sort_order' => '4'),
            array('id' => '6','user_id' => '2','quiz_id' => '5','title' => 'Mobile Communication Supports Data Transmission','image_id' => NULL,'type' => 'checkbox','score' => NULL,'sort_order' => '5'),
            array('id' => '7','user_id' => '2','quiz_id' => '6','title' => 'What are the concepts of mobile computing?','image_id' => NULL,'type' => 'text','score' => '1.0','sort_order' => '1'),
            array('id' => '8','user_id' => '2','quiz_id' => '7','title' => 'What is Mobile Computing? What are all Types','image_id' => NULL,'type' => 'textarea','score' => NULL,'sort_order' => '1'),
            array('id' => '9','user_id' => '2','quiz_id' => '10','title' => 'Which is the base of the Android Platform?','image_id' => '15','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '10','user_id' => '2','quiz_id' => '10','title' => 'Android Means','image_id' => '15','type' => 'checkbox','score' => '1.0','sort_order' => '2'),
            array('id' => '11','user_id' => '2','quiz_id' => '10','title' => 'How many layers in Android?','image_id' => '15','type' => 'checkbox','score' => '1.0','sort_order' => '3'),
            array('id' => '12','user_id' => '2','quiz_id' => '10','title' => 'Built-in Applications','image_id' => '15','type' => 'checkbox','score' => '1.0','sort_order' => '4'),
            array('id' => '13','user_id' => '2','quiz_id' => '10','title' => 'Source to running code conversion','image_id' => '15','type' => 'checkbox','score' => '1.0','sort_order' => '5'),
            array('id' => '14','user_id' => '2','quiz_id' => '10','title' => 'What is the other role of content providers?','image_id' => '15','type' => 'checkbox','score' => '1.0','sort_order' => '6'),
            array('id' => '15','user_id' => '2','quiz_id' => '10','title' => 'What are all fundamentals in Android Development?','image_id' => '15','type' => 'text','score' => '1.0','sort_order' => '7'),
            array('id' => '16','user_id' => '2','quiz_id' => '10','title' => 'What is Android Development? What are all the Fundamental concepts Behind It?','image_id' => '15','type' => 'textarea','score' => '1.0','sort_order' => '8'),
            array('id' => '17','user_id' => '5','quiz_id' => '14','title' => 'Machine Learning Classified into','image_id' => '20','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '18','user_id' => '5','quiz_id' => '14','title' => 'What is Machine Learning?','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '2'),
            array('id' => '19','user_id' => '5','quiz_id' => '14','title' => 'How many % of data is unstructured?','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '3'),
            array('id' => '20','user_id' => '5','quiz_id' => '14','title' => 'Supervised Learning is','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '4'),
            array('id' => '21','user_id' => '5','quiz_id' => '14','title' => 'Data in unsupervised Learning Has','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '5'),
            array('id' => '22','user_id' => '5','quiz_id' => '14','title' => 'Reinforcement Learning is frequently used','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '6'),
            array('id' => '23','user_id' => '5','quiz_id' => '14','title' => 'What are the types of machine learning?','image_id' => '20','type' => 'text','score' => '1.0','sort_order' => '7'),
            array('id' => '24','user_id' => '5','quiz_id' => '14','title' => 'What are all variations of Machine Learning?','image_id' => '20','type' => 'textarea','score' => '1.0','sort_order' => '8'),
            array('id' => '25','user_id' => '5','quiz_id' => '17','title' => 'What is LASSO?','image_id' => '20','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '26','user_id' => '5','quiz_id' => '17','title' => 'Regression Algorithms Applicable If the Output is','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '2'),
            array('id' => '27','user_id' => '5','quiz_id' => '17','title' => 'SVR Stands for?','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '3'),
            array('id' => '28','user_id' => '5','quiz_id' => '17','title' => 'Classification Belongs to','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '4'),
            array('id' => '29','user_id' => '5','quiz_id' => '17','title' => 'Clustering Fall Into Unsupervised Because They Follow','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '5'),
            array('id' => '30','user_id' => '5','quiz_id' => '17','title' => 'What is Anomaly Detection?','image_id' => '20','type' => 'checkbox','score' => '1.0','sort_order' => '6'),
            array('id' => '31','user_id' => '5','quiz_id' => '17','title' => 'What is the Difference between SVR and SVM?','image_id' => '20','type' => 'text','score' => '1.0','sort_order' => '7'),
            array('id' => '32','user_id' => '5','quiz_id' => '17','title' => 'How Machine Learning Techniques are Classified?','image_id' => '20','type' => 'textarea','score' => '1.0','sort_order' => '8'),
            array('id' => '33','user_id' => '6','quiz_id' => '20','title' => 'AWS Means','image_id' => '23','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '34','user_id' => '6','quiz_id' => '20','title' => 'How does CDN help Seamless integration?','image_id' => '23','type' => 'text','score' => '1.0','sort_order' => '2'),
            array('id' => '35','user_id' => '6','quiz_id' => '20','title' => 'What are all components in AWS?','image_id' => '23','type' => 'textarea','score' => '1.0','sort_order' => '3'),
            array('id' => '36','user_id' => '6','quiz_id' => '23','title' => 'MQTT Stands for?','image_id' => '23','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '38','user_id' => '6','quiz_id' => '23','title' => 'TLS protocol holds the channel for','image_id' => '23','type' => 'checkbox','score' => '1.0','sort_order' => '2'),
            array('id' => '39','user_id' => '6','quiz_id' => '23','title' => 'AWS-IoT actively communicates with?','image_id' => '23','type' => 'checkbox','score' => '1.0','sort_order' => '3'),
            array('id' => '40','user_id' => '6','quiz_id' => '23','title' => 'AWS-IoT uses Gateways','image_id' => '23','type' => 'checkbox','score' => '1.0','sort_order' => '4'),
            array('id' => '41','user_id' => '6','quiz_id' => '23','title' => 'Message Broker Provides','image_id' => '23','type' => 'checkbox','score' => '1.0','sort_order' => '5'),
            array('id' => '42','user_id' => '6','quiz_id' => '23','title' => 'AWS-IOT absorbs data by protocols?','image_id' => '23','type' => 'checkbox','score' => '1.0','sort_order' => '6'),
            array('id' => '43','user_id' => '6','quiz_id' => '23','title' => 'How Does a Message Broker Work?','image_id' => '23','type' => 'text','score' => '2.0','sort_order' => '7'),
            array('id' => '44','user_id' => '6','quiz_id' => '23','title' => 'What is the role of Device Gateway?','image_id' => '23','type' => 'textarea','score' => '2.0','sort_order' => '8'),
            array('id' => '45','user_id' => '2','quiz_id' => '25','title' => 'Mobile Computing Means','image_id' => '15','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '46','user_id' => '2','quiz_id' => '25','title' => 'What is Mobile Computing?','image_id' => '15','type' => 'radio','score' => '1.0','sort_order' => '2'),
            array('id' => '47','user_id' => '2','quiz_id' => '25','title' => 'How Many Concepts in Mobile Computing?','image_id' => '15','type' => 'radio','score' => '1.0','sort_order' => '3'),
            array('id' => '48','user_id' => '2','quiz_id' => '25','title' => 'Mobile Software Helps for','image_id' => '15','type' => 'radio','score' => '1.0','sort_order' => '4'),
            array('id' => '49','user_id' => '2','quiz_id' => '25','title' => 'What is the top-most Essential Module in the Mobile Computing','image_id' => '15','type' => 'radio','score' => '1.0','sort_order' => '5'),
            array('id' => '50','user_id' => '2','quiz_id' => '25','title' => 'What are the concepts of mobile computing?','image_id' => '15','type' => 'text','score' => '1.0','sort_order' => '6'),
            array('id' => '51','user_id' => '2','quiz_id' => '25','title' => 'What is Mobile Computing? What are all Types','image_id' => '15','type' => 'text','score' => '1.0','sort_order' => '7'),
            array('id' => '52','user_id' => '7','quiz_id' => '31','title' => 'PHP full form?','image_id' => NULL,'type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '53','user_id' => '7','quiz_id' => '31','title' => 'CSSfull form?','image_id' => NULL,'type' => 'radio','score' => '1.0','sort_order' => '2'),
            array('id' => '54','user_id' => '7','quiz_id' => '31','title' => 'HTML full form?','image_id' => NULL,'type' => 'radio','score' => '1.0','sort_order' => '3'),
            array('id' => '55','user_id' => '7','quiz_id' => '39','title' => 'PHP full form?','image_id' => NULL,'type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '56','user_id' => '7','quiz_id' => '39','title' => 'HTML full form?','image_id' => NULL,'type' => 'radio','score' => '1.0','sort_order' => '2'),
            array('id' => '57','user_id' => '7','quiz_id' => '39','title' => 'CSS full form?','image_id' => NULL,'type' => 'radio','score' => '1.0','sort_order' => '3'),
            array('id' => '58','user_id' => '2','quiz_id' => '134','title' => 'What is the full form of SQL?','image_id' => '243','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '59','user_id' => '2','quiz_id' => '134','title' => 'Which of the following is not a valid SQL type?','image_id' => '243','type' => 'radio','score' => '1.0','sort_order' => '2'),
            array('id' => '60','user_id' => '2','quiz_id' => '134','title' => 'Which of the following is not a DDL command?','image_id' => '243','type' => 'radio','score' => '1.0','sort_order' => '3'),
            array('id' => '61','user_id' => '2','quiz_id' => '134','title' => 'Which of the following are TCL commands?','image_id' => '243','type' => 'radio','score' => '1.0','sort_order' => '4'),
            array('id' => '62','user_id' => '2','quiz_id' => '134','title' => 'Which statement is used to delete all rows in a table without having the action logged?','image_id' => '243','type' => 'radio','score' => '1.0','sort_order' => '5'),
            array('id' => '63','user_id' => '5','quiz_id' => '137','title' => 'What is the maximum possible length of an identifier?','image_id' => '245','type' => 'radio','score' => '1.0','sort_order' => '1'),
            array('id' => '64','user_id' => '5','quiz_id' => '137','title' => 'Who developed the Python language?','image_id' => '245','type' => 'radio','score' => '1.0','sort_order' => '2'),
            array('id' => '65','user_id' => '5','quiz_id' => '137','title' => 'In which year was the Python language developed?','image_id' => '245','type' => 'radio','score' => '1.0','sort_order' => '3'),
            array('id' => '66','user_id' => '5','quiz_id' => '137','title' => 'In which language is Python written?','image_id' => '245','type' => 'radio','score' => '1.0','sort_order' => '4'),
            array('id' => '67','user_id' => '5','quiz_id' => '137','title' => 'Which one of the following is the correct extension of the Python file?','image_id' => '245','type' => 'radio','score' => '1.0','sort_order' => '5')
        );

        \Illuminate\Support\Facades\DB::table('questions')->insert(
            $questions
        );
    }
}
