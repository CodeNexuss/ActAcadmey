<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = ['name', 'value', 'status', 'default_language'];

    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
