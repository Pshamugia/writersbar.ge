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
        Schema::create('quizz', function (Blueprint $table) {
            $table->id();
            $table->string('mainTitle_ka')->nullable();
            $table->string('mainTitle_en')->nullable();
            $table->string('mainDescription_ka')->nullable();
            $table->string('mainDescription_en')->nullable();
            $table->string('question_ka')->nullable();
            $table->string('question_en')->nullable();
            $table->string('answerOne_ka')->nullable();
            $table->string('answerOne_en')->nullable();
            $table->string('answerTwo_ka')->nullable();
            $table->string('answerTwo_en')->nullable();
            $table->string('answerThree_ka')->nullable();
            $table->string('answerThree_en')->nullable();
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
        Schema::create('quizz', function (Blueprint $table) {
            $table->id();
            $table->string('mainTitle_ka')->nullable();
            $table->string('mainTitle_en')->nullable();
            $table->string('mainDescription_ka')->nullable();
            $table->string('mainDescription_en')->nullable();
            $table->string('question_ka')->nullable();
            $table->string('question_en')->nullable();
            $table->string('answerOne_ka')->nullable();
            $table->string('answerOne_en')->nullable();
            $table->string('answerTwo_ka')->nullable();
            $table->string('answerTwo_en')->nullable();
            $table->string('answerThree_ka')->nullable();
            $table->string('answerThree_en')->nullable();
            $table->timestamps();
        });

    }
};
