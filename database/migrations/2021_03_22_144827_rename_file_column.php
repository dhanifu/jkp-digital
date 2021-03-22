<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFileColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jkps', function (Blueprint $table) {
            $table->renameColumn('file', 'file_keagamaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jkps', function (Blueprint $table) {
            $table->renameColumn('file_keagamaan', 'file');
        });
    }
}
