<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalaccountsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externalaccounts_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id');
            $table->text('sort_code');
            $table->text('account_number');
            $table->text('bank_name');
            $table->text('account_name');
            $table->text('purpose');
            $table->text('closure_id')->nullable();
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
        Schema::dropIfExists('externalaccounts_accounts');
    }
}
