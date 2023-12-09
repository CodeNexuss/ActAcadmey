<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = [];
    protected $table = 'media';

    public function getMediaInfoAttribute(){
        $url_path = null;
        $source = get_option('default_storage');

        $slug_ext = $this->slug_ext;
        if (substr($this->mime_type, 0, 5) == 'image') {
            $slug_ext = 'images/'.$slug_ext;
        }

        if ($source == 'public'){
            $url_path = asset("uploads/".$slug_ext);
        }elseif ($source == 's3'){
            $url_path = \Illuminate\Support\Facades\Storage::disk('s3')->url("uploads/".$slug_ext);
        }

        $info = [
            'ID'            => $this->id,
            'name'          => $this->name,
            'title'         => $this->title,
            'alt_text'      => $this->alt_text,
            'slug_ext'      => $this->slug_ext,
            'size'          => $this->formatBytes(),
            'mime_type'     => $this->mime_type,
            'url'           => $url_path,
            'thumbnail'           => $url_path,
            'uploaded_at'   => $this->created_at->format(get_option('date_format')),
        ];


        if (substr($this->mime_type, 0, 5) !== 'image') {
            $info['thumbnail'] = $this->thumbnail;
        }


        return $info;
    }


    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $precision
     * @return integer
     */
    public function formatBytes($precision = 2){
        $size = $this->file_size;

        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    public function getReadableSizeAttribute(){
        return $this->formatBytes();
    }

    public function getThumbnailAttribute(){
        $thumbnail_url = asset('uploads/placeholder-image.png');
        if (substr($this->mime_type, 0, 5) == 'image') {
            $thumbnail_url = media_image_uri($this)->thumbnail;
        }
        if (substr($this->mime_type, 0, 5) == 'video') {
            $thumbnail_url = asset('uploads/video.png');
        }
        return $thumbnail_url;
    }

}
