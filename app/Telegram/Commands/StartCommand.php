<?php


namespace App\Telegram\Commands;


use App\Model\TelegramSubscribers;
use App\Repository\TelegramSubscribersRepository;
use App\Services\Telegram\Command;

class StartCommand extends Command
{
    protected $name  = "start";

    protected $description = "Start command";

    protected $showInHelpList = false;

    public function handle()
    {
        $this->Telegram
            ->setText("Привіт {$this->WebHook->getFirstName()}\n /help - отримати список команд")
            ->reply();

        $TelegramSubscribersModel = new TelegramSubscribers();
        $TelegramSubscribersRepository = new TelegramSubscribersRepository();

        if($TelegramSubscribersRepository->getByChatId($this->WebHook->getChatId()) === null) {
            $TelegramSubscribersModel->createByWebHook($this->WebHook);
        }

    }
}
