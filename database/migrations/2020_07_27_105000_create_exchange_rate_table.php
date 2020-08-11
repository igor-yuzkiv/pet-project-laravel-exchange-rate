<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rate', function (Blueprint $table) {
            $table->id();

            $table->string("currency_code");
            $table->unsignedBigInteger("bank_id");

            $table->string("sale")->nullable();
            $table->string("purchase")->nullable();

            $table->foreign("bank_id")
                ->references("id")
                ->on("banks");

            $table->foreign("currency_code")
                ->references("code")
                ->on("currencies");

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
        Schema::dropIfExists('exchange_rate');
    }
}
