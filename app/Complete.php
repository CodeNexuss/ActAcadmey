<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
    protected $guarded = [];
    protected $dates = ['completed_at'];
    public $timestamps = false;
}
