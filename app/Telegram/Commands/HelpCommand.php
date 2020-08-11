<?php


namespace App\Telegram\Commands;


use App\Services\Telegram\Command;

class HelpCommand extends Command
{
    protected $name = "help";

    protected $description = "Список команд";

    public function handle()
    {
        $text = "";

        foreach ($this->Telegram->getCommands() as $command) {
            if ($command->isShowInHelpList()) {
                $text .= "/{$command->getName()} - {$command->getDescription()}\n";
            }
        }

        $this->Telegram->setText($text)->reply();
    }
}
