<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id'); // Akun
            $table->string('nis', 8)->unique();
            $table->string('name');
            $table->uuid('rayon_id');
            $table->uuid('rombel_id');
            $table->enum('kelas', [10, 11, 12]);
            $table->enum('agama', ['Islam', 'Kristen', 'Budha', 'Hindu']);
            $table->enum('gender', ['L', 'P']);
            $table->text('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
