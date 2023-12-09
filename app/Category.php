<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $guarded = [];
    public $timestamps = true;
    public $appends = [ 'category_image_url' ];

    public function scopeParent($query){
        return $query->where('category_id', 0)->orWhere('category_id', null);
    }

    public function courses(){
        $foreignKey = 'category_id';
        if ( ! $this->step){
            $foreignKey = 'parent_category_id';
        }elseif ($this->step == 1){
            $foreignKey = 'second_category_id';
        }

        return $this->hasMany(Course::class, $foreignKey)->publish()->authorExist()->orderBy('created_at', 'desc');
    }

    public function category_courses(){
        $foreignKey = 'category_id';

        return $this->hasMany(Course::class, $foreignKey)->publish()->authorExist();
    }

    /**
     * @return string
     */
    public function categoryNameParent(){
        $parent_id = $this->category_id;
        $category_name = '';

        if($parent_id){
            $parent_category_names = [];
            while($parent_id){
                $category = DB::table('categories')->whereId($parent_id)->first();
                $parent_id = $category->category_id;
                $parent_category_names[] = $category->category_name;
            }
            //krsort($parent_category_names);
            $category_name .= ' → '.implode(' → ',$parent_category_names);
        }
        return $category_name;
    }

    public function getCategoryNameParent(){
        $category_name = $this->category_name.$this->categoryNameParent();
        return $category_name;
    }

    public function sub_categories(){
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    public function parent_category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getBgColorAttribute(){
        $bg_color = '#303'.substr(md5($this->category_name), 0, 3);
        return $bg_color;
    }

    public function getCategoryImageUrlAttribute()
    {
        $media = Media::find($this->attributes['category_image']);
        $src = ($media) ? $media->slug_ext : '';
        return url('/images/uploads/'.$src);
    }
}
