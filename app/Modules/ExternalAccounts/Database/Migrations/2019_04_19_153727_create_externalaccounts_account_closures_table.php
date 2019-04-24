<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalaccountsAccountClosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externalaccounts_account_closures', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('final_bank_statement');
            $table->unsignedInteger('confirmation_of_closure');
            $table->date('closed_on');
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
        Schema::dropIfExists('externalaccounts_account_closures');
    }
}
