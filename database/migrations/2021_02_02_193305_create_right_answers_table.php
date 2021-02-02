<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('right_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("answer_id")->nullable();
            $table->foreign("answer_id")->references("id")->on("answers")->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");

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
        Schema::dropIfExists('right_answers');
    }
}
