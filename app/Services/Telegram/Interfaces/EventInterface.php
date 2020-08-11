<?php


namespace App\Services\Telegram\Interfaces;


use App\Services\Telegram\WebHook;

interface EventInterface
{
    public function handle(WebHook $webHook);
}
