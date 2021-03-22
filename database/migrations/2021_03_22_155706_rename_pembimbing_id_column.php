<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePembimbingIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rayons', function (Blueprint $table) {
            $table->renameColumn('pembimbing_id', 'teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rayons', function (Blueprint $table) {
            $table->renameColumn('teacher_id', 'pembimbing_id');
        });
    }
}
