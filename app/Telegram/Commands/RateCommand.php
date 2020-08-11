<?php


namespace App\Telegram\Commands;


use App\Repository\BankRepository;
use App\Repository\ExchangeRateRepository;
use App\Repository\TelegramSubscribersRepository;
use App\Services\Telegram\Command;
use App\Services\Telegram\Objects\KeyboardObject;
use Illuminate\Support\Facades\Log;

/**
 * Class ExchangeRateCommand
 * @package App\Telegram\Commands
 */
class RateCommand extends Command
{
    public $name = "rate";

    public $description = "Курс валют сьогодні";


    public function handle()
    {
        $arguments = $this->WebHook->getArguments();
        if (!$this->WebHook->hasArguments()) {
            $this->sendKeyboard();
        } else {
            switch ($arguments[0]) {
                case "Середній":
                    $this->average();
                    break;
                case "Банки":
                    $this->banks();
                    break;
            }
        }
    }

    private function sendKeyboard() {
        $this->Telegram->removeKeyboard();

        $keyboard = new KeyboardObject();
        $keyboard->addButton("/rate Середній");
        $keyboard->addButton("/rate Банки");

        $this->Telegram->setKeyboard($keyboard, $this->description)->reply();
    }

    private function average()
    {
        $text = (new TelegramSubscribersRepository()) -> getRateAverageForMailing();
        $this->Telegram->setText($text)->reply();
    }

    private function banks()
    {
        $text = (new TelegramSubscribersRepository()) -> getRateByBankForMailing();
        $this->Telegram->setText($text)->reply();
    }

}
