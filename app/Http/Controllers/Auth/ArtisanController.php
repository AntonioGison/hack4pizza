<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArtisanController extends Controller
{
  public function clear(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
  }
}