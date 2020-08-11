<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value'
    ];


}
