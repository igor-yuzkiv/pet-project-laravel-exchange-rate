<?php

namespace App\Console\Commands\Telegram;

use App\Repository\TelegramSubscribersRepository;
use App\Services\Telegram\TelegramApi;
use Illuminate\Console\Command;

class TelegramMailingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:mailing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mailing telegram';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $TelegramSubscribersRepository = new TelegramSubscribersRepository();
        $subscribers = $TelegramSubscribersRepository->getMailingSubscribers();

        $textAverage = $TelegramSubscribersRepository->getRateAverageForMailing();
        $textByBank = $TelegramSubscribersRepository->getRateByBankForMailing();

        $TelegramApi = new TelegramApi();

        foreach ($subscribers as $subscriber) {
            $options = $subscriber->getAttribute("mailing_options");

            $TelegramApi->setChatId($subscriber->chat_id);

            if (!empty($options) and isset($options["type"])) {
                switch ($options["type"]) {
                    case "banks":
                        $TelegramApi->setText($textByBank)->reply();
                        break;
                    case "average":
                        $TelegramApi->setText($textAverage)->reply();
                        break;
                }
            }

        }


    }
}
