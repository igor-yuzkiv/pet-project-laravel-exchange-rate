<?php


namespace App\Services\Telegram\Events;


use App\Services\Telegram\Interfaces\EventInterface;
use App\Services\Telegram\WebHook;

class IgnoreEvent implements EventInterface
{
    public function handle(WebHook $webHook)
    {
        // TODO: Implement handle() method.
    }

}
