<?php

namespace App\Http\Controllers\Backend;

use App\Forms\BankForm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ControllerTrait;
use App\Http\Requests\Bank\BankStoreRequest;
use App\Model\Bank;
use App\Repository\BankRepository;
use App\Services\Crawler\CrawlerCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class BankController extends Controller
{
    use ControllerTrait;

    /**
     * @var BankRepository
     */
    private $BankRepository;

    public function __construct()
    {
        $this->BankRepository = app(BankRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataTable = $this->BankRepository->getAll();


        return view("Backend.bank.index", [
            "title" => "Banks",
            "dataTable" => $dataTable,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(BankForm::class, [
            "method" => "POST",
            "url" => route("backend.banks.store")
        ]);

        return view($this->viewSimpleForm, [
            "title" => __("title.bank_index"),
            "form" => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BankStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BankStoreRequest $request)
    {
        $bankModel = new Bank();
        $result = $bankModel->store($request->input(), null);


        return $this->returnResultRedirectWithMessage($result, "backend.banks.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $model = $this->BankRepository->getForEdit($id);
        $bank_options = $model->banks_options()->first();


        $form = $formBuilder->create(BankForm::class, [
            "method" => "PUT",
            "url" => route("backend.banks.update", $id),
            "model" => $model,
        ]);

        return view("Backend.bank.bankFormEdit", [
            "title" => "Title",
            "form" => $form,
            "model" => $model,
            "bank_options" => $bank_options
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->input(), (new BankStoreRequest())->rules_update($id))->validate();

        $bankModel = new Bank();
        $result = $bankModel->storeAndReturnModel($request->input(), $id, ["is_enable"]);

        if ($request->has("bank_logo")) {
            $bankModel->upload_log($result->id, $request->file("bank_logo"));
        }

        return $this->returnResultRedirectWithMessage($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $result = Bank::destroy($id);
        return $this->returnResultRedirectWithMessage($result);
    }

    public function changeEnable ($id) {
        $result = (new Bank()) -> changeEnable($id);
        return $this->returnResultRedirectWithMessage($result);
    }


    public function rateToDay($id) {
        $Crawler = new CrawlerCurrency();
        $bankInfo = $this->BankRepository->getForEdit($id);

        $rate = $Crawler->getByBankId($id);

        return view("Backend.bank.rateToDay", [
            "dataTable" => $rate,
            "title" => __("title.bank.rate_to_day", ["bankName" => $bankInfo->name]),
            "bankInfo" => $bankInfo,
        ]);
    }

}
