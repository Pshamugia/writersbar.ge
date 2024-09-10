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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('subkat')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
            $table->string('full')->nullable(false)->change();
            $table->string('upload')->nullable(false)->change();
            $table->integer('category_id')->nullable(false)->change();
        });
    }


};

