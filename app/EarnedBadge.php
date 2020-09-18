<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarnedBadge extends Model
{
    public function badge(){
        return $this->belongsTo('App\Badge' ,'badge_id');
    }    
}
