<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotQuestionaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_questionaire', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("questionaire_id");
            $table->foreign("questionaire_id")->references("id")->on("questionaires")->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger("question_id");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade")->onUpdate("cascade");

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
        Schema::dropIfExists('pivot_questionaire');
    }
}
