<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSafeguardingAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safeguarding_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('correct');
            $table->unsignedInteger('question_id');
            $table->timestamps();
        });

        Schema::table('safeguarding_answers', function(Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('safeguarding_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('safeguarding_answers');
    }
}
