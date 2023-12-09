<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function scopePublish($query){
        return $query->where('status', 1)->orderBy('created_at', 'desc');
    }
    public function scopePost($query){
        return $query->where('type', 'post')->with('media', 'author');
    }

    public function getPublishedTimeAttribute(){
        return $this->created_at->format(date_time_format());
    }
    public function getUrlAttribute(){
        return route('post', $this->slug);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media(){
        return $this->belongsTo(Media::class, 'feature_image');
    }
    public function getThumbnailUrlAttribute(){
        return media_image_uri($this->media);
    }

    public function getStatusContextAttribute(){
        $statusClass = "";
        $iclass = "";
        $status = __a('pending');
        switch ($this->status){
            case '0':
                $statusClass .= "dark";
                $iclass = "clock-o";
                break;
            case '1':
                $statusClass .= "success";
                $iclass = "check-circle";
                $status = __a('published');
                break;
            case '2':
                $statusClass .= "danger";
                $iclass = "exclamation-circle";
                $status = __a('unpublished');
                break;
        }

        $html = "<span class='badge post-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$status}</span>";
        return $html;
    }


}
