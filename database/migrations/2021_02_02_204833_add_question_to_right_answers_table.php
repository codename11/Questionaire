<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionToRightAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('right_answers', function (Blueprint $table) {
            $table->unsignedBigInteger("question_id")->nullable();
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('right_answers', function (Blueprint $table) {
            //
        });
    }
}
