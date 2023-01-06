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
        Schema::create('table_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->integer('account_number');
            $table->double('balance', 20, 2);
            $table->foreignId('customer');
            $table->foreignId('input_by');
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
        Schema::dropIfExists('table_bank_accounts');
    }
};
