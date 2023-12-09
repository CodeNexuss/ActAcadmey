<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function media(){
        return $this->belongsTo(Media::class, 'image_id');
    }
    public function options(){
        return $this->hasMany(QuestionOption::class)->orderBy('sort_order', 'asc');
    }
    public function getImageUrlAttribute(){
        return media_image_uri($this->media);
    }
    public function delete_sync(){
        $this->options()->delete();
        $this->delete();
    }

}
