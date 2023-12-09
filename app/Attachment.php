<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function media(){
        return $this->belongsTo(Media::class);
    }

    public function belongs_item(){
        return $this->belongsTo(Content::class, 'content_id');
    }

    public function course(){
        if ($this->course_id){
            return $this->belongsTo(Course::class, 'course_id');
        }
        if ($this->belongs_course_id){
            return $this->belongsTo(Course::class, 'belongs_course_id');
        }
    }

}
