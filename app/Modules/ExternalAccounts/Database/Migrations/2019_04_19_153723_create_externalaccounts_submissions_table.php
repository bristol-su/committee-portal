<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalaccountsSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externalaccounts_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('position_id');
            $table->year('year');
            $table->boolean('conditions_met');
            $table->text('missing_functionality')->nullable();
            $table->text('potential_income_lost')->nullable();
            $table->date('year_end');
            $table->json('accounts')->nullable();
            $table->json('statements');
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
        Schema::dropIfExists('externalaccounts_submissions');
    }
}
