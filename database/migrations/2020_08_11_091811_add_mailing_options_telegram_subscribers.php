<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailingOptionsTelegramSubscribers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telegram_subscribers', function (Blueprint $table) {
            $table->boolean("is_subscriber")->default(false);
            $table->longText("mailing_options")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telegram_subscribers', function (Blueprint $table) {
            $table->dropColumn("is_subscriber");
            $table->dropColumn("mailing_options");
        });
    }
}
