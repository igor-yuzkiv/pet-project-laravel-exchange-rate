<?php


namespace App\Services\Telegram\Events;


use App\Services\Telegram\Command;
use App\Services\Telegram\Interfaces\EventInterface;
use App\Services\Telegram\Telegram;
use App\Services\Telegram\WebHook;

class CommandEvent implements EventInterface
{
    /**
     * @var WebHook
     */
    private $webHook;

    /**
     * @param WebHook $webHook
     */
    public function handle(WebHook $webHook)
    {
        $this->webHook = $webHook;

        if($this->checkCommand()) {
            $command = $this->getCommand();
            $command->setWebHook($webHook);
            $command->setTelegram(new Telegram($webHook));
            $command->handle();
        }
    }

    /**
     * @return bool
     */
    public function checkCommand () : bool {
        $class_name = config("telegram.commands.".$this->webHook->getCommandName());

        if ( $class_name !== null AND class_exists($class_name)) {
            return  true;
        }else {
            return false;
        }
    }

    /**
     * @return Command
     */
    public function getCommand() : Command {
        $class_command = config("telegram.commands.".$this->webHook->getCommandName());
        return  new $class_command;
    }
}
