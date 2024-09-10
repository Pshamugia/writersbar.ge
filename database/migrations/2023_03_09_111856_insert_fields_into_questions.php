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
        Schema::table('questions', function (Blueprint $table) {
            $table->string('feedbackTwo_ka')->nullable();
            $table->string('feedbackTwo_en')->nullable();
            $table->string('feedbackThree_ka')->nullable();
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
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('feedbackTwo_ka');
            $table->dropColumn('feedbackTwo_en');
            $table->dropColumn('feedbackThree_ka');
            $table->dropColumn('feedbackThree_en');
        });
    }
};
