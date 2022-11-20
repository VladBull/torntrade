<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('trade_histories', function (Blueprint $table) {
            $table->id();
            $table->longText('summary')->nullable();
            $table->unsignedBigInteger('total')->nullable()->default('0');
            $table->BigInteger('profit')->nullable()->default('0');
            $table->BigInteger('total_items')->default('0');
            $table->unsignedBigInteger('client_id');
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
        Schema::dropIfExists('trade_histories');
    }
}


