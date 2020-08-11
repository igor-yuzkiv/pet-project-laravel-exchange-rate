<?php


namespace App\Telegram\Commands;


use App\Model\TelegramSubscribers;
use App\Services\Telegram\Command;
use App\Services\Telegram\Objects\KeyboardObject;

/**
 * Class MailingSubscribeCommand
 * @package App\Telegram\Commands
 */
class MailingSubscribeCommand extends Command
{
    /**
     * @var string
     */
    protected $name = "mailing";

    /**
     * @var string
     */
    protected $description = "Підписка на розсилку";

    /**
     *
     */
    public function handle()
    {
        if (!$this->WebHook->hasArguments()) {
            $this->sendKeyboard();
        } else {
            switch ($this->WebHook->getArguments()[0]) {
                case "Середній":
                    $this->average();
                    break;
                case "Банки":
                    $this->banks();
                    break;
            }
        }
    }


    /**
     *
     */
    private function average()
    {
        $TelegramSubscribersModel = new TelegramSubscribers();
        $TelegramSubscribersModel->setSubscribeOptionsByWebHook($this->WebHook, [
            "type" => "average"
        ]);

        $this->Telegram
            ->removeKeyboard()
            ->setText("Підписку зареєстрованно. \nЩо дня, ви будете отримувати середній курс валют.")
            ->reply();
    }

    /**
     *
     */
    private function banks()
    {
        $TelegramSubscribersModel = new TelegramSubscribers();
        $TelegramSubscribersModel->setSubscribeOptionsByWebHook($this->WebHook, [
            "type" => "banks"
        ]);

        $this->Telegram
            ->removeKeyboard()
            ->setText("Підписку зареєстрованно. \nЩо дня, ви будете отримувати курс валют в розрізі за банком.")
            ->reply();
    }

    /**
     *
     */
    public function sendKeyboard()
    {
        $this->Telegram->removeKeyboard();

        $keyboard = new KeyboardObject();

        $keyboard->addButton("/mailing Середній");
        $keyboard->addButton("/mailing Банки");

        $this->Telegram->setKeyboard($keyboard, $this->description)->reply();
    }

}
