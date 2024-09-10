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
            $table->longText('feedbackOne_ka')->change();
            $table->longText('feedbackTwo_ka')->change();
            $table->longText('feedbackThree_ka')->change();
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
            $table->dropColumn('feedbackOne_ka');
            $table->dropColumn('feedbackTwo_ka');
            $table->dropColumn('feedbackThree_ka');
        });
    }
};
