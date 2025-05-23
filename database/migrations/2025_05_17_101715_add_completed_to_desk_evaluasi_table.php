<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('desk_evaluasi', function (Blueprint $table) {
            $table->boolean('completed')->default(false);
        });
    }

    public function down()
    {
        Schema::table('desk_evaluasi', function (Blueprint $table) {
            $table->dropColumn('completed');
        });
    }
};