<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExitingtreasurerMissingIncomeAndExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exitingtreasurer_missing_income_and_expenditures', function (Blueprint $table) {
            $table->increments('id');
            $table->text('note')->nullable();
            $table->unsignedInteger('submission_id');
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
        Schema::dropIfExists('exitingtreasurer_missing_income_and_expenditures');
    }
}
