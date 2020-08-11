<?php

namespace App\Repository;

use App\Model\TelegramSubscribers as Model;

class TelegramSubscribersRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getByChatId($chatId) {
        $result = $this->startCondition()
            ->whereChat_id($chatId)
            ->first();

        return $result;
    }

    public function getMailingSubscribers() {
        $result = $this->startCondition()
            ->where("is_subscriber", true)
            ->get();

        return $result;
    }


    public function getRateAverageForMailing() : string {
        $ExchangeRateRepository = new ExchangeRateRepository();
        $text = "";

        foreach ($ExchangeRateRepository->getAverage(true) as $item) {
            $text .= "<== {$item->currency_code}-{$item->currency_name} ==> \n" .
                "Купівля: {$item->purchase}\n" .
                "Продажа: {$item->sale}\n\n";
        }

        return  $text;
    }

    public function getRateByBankForMailing() : string {
        $banks = (new BankRepository())->getEnabledBanks();
        $ExchangeRateRepository = new ExchangeRateRepository();

        $text = "";
        foreach ($banks as $bank) {
            $text .= "<== {$bank->name} ==> \n";
            foreach ($ExchangeRateRepository->getRateByBank($bank->id, true) as $item) {
                $text .= "<-- {$item->currency_code}-{$item->currency_name} -->\n" .
                    "Купівля: {$item->purchase}\n" .
                    "Продажа: {$item->sale}\n";
            }
            $text .= "\n\n";
        }

        return  $text;
    }
}
