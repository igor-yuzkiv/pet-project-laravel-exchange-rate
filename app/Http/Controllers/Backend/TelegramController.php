<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Bank;
use App\Repository\BankRepository;
use App\Repository\ExchangeRateRepository;
use App\Repository\TelegramSubscribersRepository;
use App\Services\Telegram\Objects\KeyboardObject;
use App\Services\Telegram\Telegram;
use App\Services\Telegram\TelegramApi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TelegramController extends Controller
{
    public function index() {
        /*$TelegramSubscribersRepository = new TelegramSubscribersRepository();
        $ExchangeRateRepository = new ExchangeRateRepository();
        $subscriber = $TelegramSubscribersRepository->getForEdit(1);


        $TelegramApi = new TelegramApi();
        $TelegramApi->setChatId($subscriber->chat_id);
        $text = "";

        if ($subscriber->getAttribute("mailing_options")["type"] == "average") {
            foreach ($ExchangeRateRepository->getAverage(true) as $item) {
                $text .= "<== {$item->currency_code}-{$item->currency_name} ==> \n" .
                    "Купівля: {$item->purchase}\n" .
                    "Продажа: {$item->sale}\n\n";
            }


        }else {
            $banks = (new BankRepository())->getEnabledBanks();
            foreach ($banks as $bank) {
                $text .= "<== {$bank->name} ==> \n";
                foreach ($ExchangeRateRepository->getRateByBank($bank->id, true) as $item) {
                    $text .= "<-- {$item->currency_code}-{$item->currency_name} -->\n" .
                        "Купівля: {$item->purchase}\n" .
                        "Продажа: {$item->sale}\n";
                }
                $text .= "\n\n";
            }
        }

        $TelegramApi->setText($text)->reply();

        dd($subscriber);
        $file = Storage::get("public/telegram_dump.txt");
        dd(json_decode($file, true));*/
    }
}
