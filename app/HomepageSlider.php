<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSlider extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'description', 'image', 'status', 'order', 'url' ];
    public $appends = [ 'slider_url' ];

    public function getSliderUrlAttribute()
    {
        $media = Media::find($this->attributes['image']);
        $src = ($media) ? $media->slug_ext : '';
        return url('/uploads/images/'.$src);
    }
}
