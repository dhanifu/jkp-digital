<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileKegiatanlainToJkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jkps', function (Blueprint $table) {
            $table->text('file_literasi')->after('file_keagamaan');
            $table->text('file_kesehatan')->after('file_literasi');
            $table->text('file_lingkungan')->after('file_kesehatan');
            $table->text('file_pramuka')->nullable()->after('file_lingkungan');
            $table->dropColumn('updated_by');
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
            $table->dropColumn('file_literasi');
            $table->dropColumn('file_kesehatan');
            $table->dropColumn('file_lingkungan');
            $table->dropColumn('file_pramuka');
            $table->uuid('updated_by')->nullable()->after('updated_by');
        });
    }
}
