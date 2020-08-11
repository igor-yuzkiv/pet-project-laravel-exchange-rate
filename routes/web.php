<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(["prefix" => "", "as" => "frontend."], function () {
    Route::get('/', "Frontend\HomeController@index")->name("home");

    Route::group(["prefix" => "exchange-rate", "as" => "exchange-rate."], function () {
        Route::get("/", "Frontend\ExchangeRateController@index")->name("index") -> middleware("exchange_rate.index.default.filter");;
    });
});

/**
 * Backend - Admin
 */

Route::group(["prefix" => "admin", "as" => "backend."], function () {
    Auth::routes(["register" => false, "reset" => false]);
});

Route::group(["prefix" => "admin", "as" => "backend.", "middleware" => "auth"], function () {

    Route::get("/", function () {
        return view("Backend.index", ["title" => "Index"]);
    });

    Route::resource("banks", "Backend\BankController")->except(["show", "destroy"]);
    Route::group(["prefix" => "banks", "as" => "banks."], function () {
        Route::get("destroy/{id}", "Backend\BankController@destroy") -> where(["id" => "[0-9]+"]) -> name("destroy");
        Route::get("change-enable/{id}", "Backend\BankController@changeEnable") -> where(["id" => "[0-9]+"]) -> name("changeEnable");
        Route::get("rate-to-day/{id}", "Backend\BankController@rateToDay") -> where(["id" => "[0-9]+"]) -> name("rateToDay");
    });

    Route::resource("banks-options", "Backend\BanksOptionsController")->except(["show", "destroy", "index"]);
    Route::group(["prefix" => "banks-options", "as" => "banks-options."], function () {
        Route::get("destroy/{id}", "Backend\BanksOptionsController@destroy") -> where(["id" => "[0-9]+"]) -> name("destroy");
        Route::get("query-attributes/{id}", "Backend\BanksOptionsController@query_attributes") ->where(["id" => "[0-9]+"]) -> name("query_attributes");
        Route::post("query-attributes-store/{id}", "Backend\BanksOptionsController@query_attributes_store") -> where(["id" => "[0-9]+"]) -> name("query_attributes_store");
        Route::get("query-attributes-delete/{id}/{key}", "Backend\BanksOptionsController@query_attributes_delete") -> where(["id" => "[0-9]+"]) -> name("query_attributes_delete");
    });

    Route::group(["prefix" => "translator", "as" => "translator."], function () {
        Route::resource("translations", "Backend\Translator\TranslationsController")->except(["show", "destroy"]);
        Route::get("language-delete/{id}", "Backend\Translator\TranslationsController@destroy") -> where(["id" => "[0-9]+"]) -> name("destroy-language");
    });

    Route::group(["prefix" => "currency", "as" => "currency."], function () {
        Route::get("/", "Backend\CurrencyController@index")->name("index");
        Route::get("destroy/{id}", "Backend\CurrencyController@destroy") -> name("destroy");
        Route::get("import-currencies-nbu", "Backend\CurrencyController@import_currencies_nbu")->name("import_currencies_nbu");
    });
    Route::resource("currency", "Backend\CurrencyController") -> except(["index", "destroy", "show"]);

    Route::group(["prefix" => "exchange-rate", "as" => "exchange-rate."], function () {
        Route::get("/", "Backend\ExchangeRateController@index")->name("index") -> middleware("exchange_rate.index.default.filter");
        Route::get("parse-exchange-rate-today", "Backend\ExchangeRateController@parseExchangeRateToday")->name("parseExchangeRateToday");
    });

    Route::get("telegram", "Backend\TelegramController@index");

});
