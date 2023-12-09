<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'contents';
    protected $guarded = [];

    public function questions(){
        return $this->hasMany(Question::class, 'quiz_id')->with('media');
    }
    public function attempts(){
        return $this->hasMany(Attempt::class, 'quiz_id');
    }
    public function option($key = null, $default = null){
        $options = null;
        if ($this->options){
            $options = json_decode($this->options, true);
        }
        if ($key){
            if (is_array($options) && array_get($options, $key)){
                return array_get($options, $key);
            }else{
                return $default;
            }
        }

        return $options;
    }

    public function getUrlAttribute(){
        return route('single_quiz', [$this->course_id, $this->id]);
    }

}
