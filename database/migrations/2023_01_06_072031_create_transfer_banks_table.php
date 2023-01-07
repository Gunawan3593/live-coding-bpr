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
        Schema::create('transfer_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_from');
            $table->foreignId('account_from');
            $table->foreignId('customer_to');
            $table->foreignId('account_to');
            $table->double('nominal', 20, 2);
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
        Schema::dropIfExists('transfer_banks');
    }
};
