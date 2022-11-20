<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('game_item_id')->unique();
            $table->text('description')->nullable()->default(null);
            $table->string('type');
            $table->unsignedBigInteger('my_price')->default('0');
            $table->unsignedBigInteger('buy_price')->default('0');
            $table->unsignedBigInteger('sell_price')->default('0');
            $table->unsignedBigInteger('market_value')->default('0');
            $table->unsignedBigInteger('circulation')->default('0');
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
        Schema::dropIfExists('items');
    }
}
