<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarnedBadge extends Model
{
    protected $fillable = [
        'user_id', 'badge_id', 'count'
    ];

    public function badge(){
        return $this->belongsTo('App\Badge' ,'badge_id');
    }    
}
