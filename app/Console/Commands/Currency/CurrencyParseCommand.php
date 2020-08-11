<?php

namespace App\Console\Commands\Currency;

use App\Repository\ExchangeRateRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CurrencyParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:parse {--date=}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currency';

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $date = ($this->option("date"))
            ? Carbon::createFromDate($this->option("date")) -> format("Y-m-d")
            : Carbon::now()->format("Y-m-d");

        (new ExchangeRateRepository()) -> parseCurrency($date);

        $this->info("Completed");
    }
}
