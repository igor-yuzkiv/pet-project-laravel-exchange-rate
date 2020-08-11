<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/K2giMbO1fOZ4dGre9YYAbrnamNVLAz6TJb2POPdVu4b0KSSYK7CybTI25N2kz77V/webhook', function () {
    \App\Services\Telegram\TelegramInitial::initWebHook();
});

Route::get('/setwebhook', function () {
    $webhook_url = "https://currency.igor-yuzkiv.website/api/K2giMbO1fOZ4dGre9YYAbrnamNVLAz6TJb2POPdVu4b0KSSYK7CybTI25N2kz77V/webhook";
    $token = "949114473:AAFwmENelUDVk3l3t6nLqQdE_FuHcYm8sVQ";

    $client = new \GuzzleHttp\Client();
    $request = $client->request("POST", "https://api.telegram.org/bot{$token}/setWebhook?url={$webhook_url}");

    dd($request->getBody()->getContents());
});
