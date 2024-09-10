<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('upload1')->nullable();
            $table->string('upload2')->nullable();
            $table->string('upload3')->nullable();
            $table->string('upload4')->nullable();
            $table->string('upload5')->nullable();
            $table->string('upload6')->nullable();
            $table->string('upload7')->nullable();
            $table->string('upload8')->nullable();
            $table->string('upload9')->nullable();
            $table->string('upload10')->nullable();
            $table->string('upload11')->nullable();
            $table->string('upload12')->nullable();
            $table->string('upload13')->nullable();
            $table->string('upload14')->nullable();
            $table->string('upload15')->nullable();
            $table->string('upload16')->nullable();
            $table->string('upload17')->nullable();
            $table->string('upload18')->nullable();
            $table->string('upload19')->nullable();
            $table->string('upload20')->nullable();


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
        Schema::dropIfExists('gallery');
    }
};
