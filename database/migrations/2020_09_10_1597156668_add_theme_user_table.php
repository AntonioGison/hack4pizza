<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThemeUserTable extends Migration
{
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('theme')->after('remember_token')->nullable()->comment('dark,light');
        });
    }

    public function down()
    {
        
    }
}
