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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quizz_id');
            $table->string('question_ka')->nullable();
            $table->string('question_en')->nullable();
            $table->string('answerOne_ka')->nullable();
            $table->string('answerOne_en')->nullable();
            $table->string('answerTwo_ka')->nullable();
            $table->string('answerTwo_en')->nullable();
            $table->string('answerThree_ka')->nullable();
            $table->string('answerThree_en')->nullable();
            $table->string('correct')->nullable();
            $table->string('feedbackOne_ka')->nullable();
            $table->string('feedbackOne_en')->nullable();
            $table->string('upload')->nullable();
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
        Schema::dropIfExists('questions');
    }
};
