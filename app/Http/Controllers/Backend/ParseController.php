<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Bank;
use App\Model\BankOptions;
use App\Repository\BankRepository;
use App\Services\Crawler\CrawlerCurrency;
use Illuminate\Http\Request;

class ParseController extends Controller
{

    /**
     * @var BankRepository
     */
    private $BankRepository;

    public function __construct()
    {
        $this->BankRepository = app($this->BankRepository);
    }

    public function index() {

    }

}
