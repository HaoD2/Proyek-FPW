<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hjual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hjual', function (Blueprint $table) {
            $table->id();
            $table->string('email_pembeli');
            $table->foreign('email_pembeli')->references('email')->on('users')->onDelete('cascade');
            $table->integer('total_pembelian');
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
        Schema::dropIfExists('hjual');
    }
}
