<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
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
            $table->string("name");
            $table->string("description");

            $table->unsignedBigInteger("status_id");
            $table->foreign("status_id")->references("id")->on("pivot_status")->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger("field_type_id");
            $table->foreign("field_type_id")->references("id")->on("field_type")->onDelete("cascade")->onUpdate("cascade");

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
}
