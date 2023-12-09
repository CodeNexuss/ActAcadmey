<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $guarded = [];

    protected $casts = [
        'evaluated_at' => 'datetime',
    ];

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }
    public function student(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function assignment(){
        return $this->belongsTo(Content::class, 'assignment_id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function instructor(){
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
