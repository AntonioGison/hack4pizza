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
        'name', 'email','slug', 'password','pic','name1','name2','name3','url1','url2','url3','linkedin_id','github_id','bio',
    ];

    public function experiences(){
        return $this->hasMany('App\Experience','user_id')->orderBy("created_at","DESC");
    }
    public function performance(){
        return $this->hasOne('App\Performance','user_id');
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
