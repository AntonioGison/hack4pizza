<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name','first_name','last_name', 'email', 'phone_number', 'slug', 'password','profile_picture','facebook_id', 'linked_id','github_id','bio',
    ];

    public function earned_badges(){
        return $this->hasMany('App\EarnedBadge','user_id');
    }
    public function first_badges(){
        return $this->hasMany('App\EarnedBadge','user_id')->where('badge_id','1');
    }
    public function second_badges(){
        return $this->hasMany('App\EarnedBadge','user_id')->where('badge_id','2');
    }
    public function third_badges(){
        return $this->hasMany('App\EarnedBadge','user_id')->where('badge_id','3');
    }
    public function experiences(){
        return $this->hasMany('App\Experience','user_id')->orderBy("created_at","DESC");
    }
    public function performance(){
        return $this->hasOne('App\Performance','user_id');
    }
    public function getRecentSearchesAttribute(){
        $searches = RecentSearch::where('user_id',$this->id)->orderBy('id','desc')->get()->take(5);
        return $searches;
        // return $this->hasMany('App\RecentSearch','user_id');
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
