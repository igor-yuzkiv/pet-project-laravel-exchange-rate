<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repository\BankRepository;
use App\Repository\CurrencyRepository;
use App\Repository\ExchangeRateRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @var ExchangeRateRepository
     */
    private $ExchangeRateRepository;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->ExchangeRateRepository = app(ExchangeRateRepository::class);
    }

    public function index() {

        return view("Frontend.home", [
            "title" => __("frontend.menu.exchange_rate.home"),
            "rateBaseCurrency" => $this->ExchangeRateRepository->getAverage(true),
        ]);
    }
}
