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
        Schema::table('quizz', function (Blueprint $table) {
            $table->string('feedbackOne_ka')->nullable();
            $table->string('feedbackTwo_ka')->nullable();
            $table->string('feedbackThree_ka')->nullable();
            $table->string('feedbackOne_en')->nullable();
            $table->string('feedbackTwo_en')->nullable();
            $table->string('feedbackThree_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizz', function (Blueprint $table) {
            $table->string('feedbackOne_ka')->nullable();
            $table->string('feedbackTwo_ka')->nullable();
            $table->string('feedbackThree_ka')->nullable();
            $table->string('feedbackOne_en')->nullable();
            $table->string('feedbackTwo_en')->nullable();
            $table->string('feedbackThree_en')->nullable();
        });
    }
};
