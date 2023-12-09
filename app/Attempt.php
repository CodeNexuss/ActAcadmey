<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Attempt extends Model
{
    protected $guarded = [];

    protected $dates = ['ended_at'];

    public function answers(){
        return $this->hasMany(Answer::class)->with('question');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function quiz(){
        return $this->belongsTo(Content::class, 'quiz_id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getStatusHtmlAttribute(){
        $statusClass = "";
        $iclass = "";
        switch ($this->status){
            case 'started':
                $statusClass .= "dark";
                $iclass = "clock-o";
                break;
            case 'in_review':
                $statusClass .= "warning";
                $iclass = "hourglass";
                break;
            case 'finished':
                $statusClass .= "success";
                $iclass = "check-circle";
                break;
        }

        $html = "<span class='badge p-2 px-3 payment-status-{$this->status} badge-{$statusClass}' style='font-size:16px'> <i style='font-size:16px;vertical-align: middle;' class='la la-{$iclass}' mr-1></i> {$this->status}</span>";
        return $html;

    }


    public function save_and_sync($data = []){
        if (is_array($data) && count($data)){
            $this->update($data);
        }else{
            $this->save();
        }

        $q_score = $this->answers->sum('q_score');
        $r_score = $this->answers->sum('r_score');

        $earned_percent = 0;
        if ($r_score > 0){
            $earned_percent = (100 * $r_score) / $q_score;
        }

        $passing_percent = (int) $this->quiz->option('passing_score');

        $passed = $earned_percent >= $passing_percent ? 1 : 0;

        $this->earned_scores = $r_score;
        $this->earned_percent = $earned_percent;
        $this->passed = $passed;
        $this->save();

        $content = Content::find($this->quiz_id);
        complete_content($content, $this->user);

        return $this;
    }


}
