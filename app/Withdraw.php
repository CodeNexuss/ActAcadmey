<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $guarded = [];

    public function getMethodDataAttribute($value){
        if ($value){
            return json_decode($value, true);
        }
        return null;
    }



    public function getStatusContextAttribute(){
        $statusClass = "";
        $iclass = "";
        switch ($this->status){
            case 'pending':
                $statusClass .= "dark";
                $iclass = "clock-o";
                break;
            case 'approved':
                $statusClass .= "success";
                $iclass = "check-circle";
                break;
            case 'rejected':
                $statusClass .= "danger";
                $iclass = "exclamation-circle";
                break;
        }

        $html = "<span class='badge withdraw-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$this->status}</span>";
        return $html;
    }


}
