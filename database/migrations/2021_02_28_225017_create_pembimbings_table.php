<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembimbingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembimbings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id'); // Akun
            $table->string('nip')->unique();
            $table->string('name');
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
        Schema::dropIfExists('pembimbings');
    }
}
