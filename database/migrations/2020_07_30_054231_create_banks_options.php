<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks_options', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("bank_id");

            $table->string("base_url");
            $table->string("result_selector") -> nullable();

            $table->string("date_query_param") -> nullable();
            $table->string("date_format")->nullable();

            $table->string("replace_key_sale") -> nullable();
            $table->string("replace_key_purchase") -> nullable();
            $table->string("replace_key_currency_code") -> nullable();

            $table->string("request_method")->default("GET");
            $table->string("request_content_type")->default("json");

            $table->string("parse_class")->nullable();

            /**
             * array
             */
            $table->longText("query_attributes")->nullable();

            $table->foreign("bank_id")
                ->references("id")
                ->on("banks")
                ->onDelete("cascade");

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
        Schema::dropIfExists('banks_options');
    }
}
