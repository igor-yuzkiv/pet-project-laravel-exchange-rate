<?php

namespace App\Http\Controllers\Backend;

use App\Forms\CurrencyForm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ControllerTrait;
use App\Http\Requests\CurrencyRequest;
use App\Model\Currency;
use App\Repository\CurrencyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kris\LaravelFormBuilder\FormBuilder;

class CurrencyController extends Controller
{
    use ControllerTrait;

    /**
     * @var CurrencyRepository
     */
    private $CurrencyRepository;

    public function __construct()
    {
        $this->CurrencyRepository = app(CurrencyRepository::class);
    }

    public function index() {
        $dataTable = $this->CurrencyRepository->getAll();

        return view("Backend.currency.index", [
            "dataTable" => $dataTable,
            "title" => __("title.currency_index")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CurrencyForm::class, [
            "method" => "POST",
            "url" => route("backend.currency.store")
        ]);

        return view($this->viewSimpleForm, [
            "title" => __("title.currency.create"),
            "form" => $form
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CurrencyRequest $request)
    {
        $result = (new Currency()) -> store($request->input());
        return  $this->returnResultRedirectWithMessage($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CurrencyForm::class, [
            "method" => "PUT",
            "url" => route("backend.currency.update", $id),
            "model" => $this->CurrencyRepository->getForEdit($id, ["*"], "code"),
        ]);

        return view($this->viewSimpleForm, [
            "title" => __("title.currency.edit"),
            "form" => $form
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $result = (new Currency()) -> store($request->input(), $id, [], 'code');
        return  $this->returnResultRedirectWithMessage($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $result = Currency::destroy($id);
        return  $this->returnResultRedirectWithMessage($result);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function import_currencies_nbu () {
        $currencies = $this->CurrencyRepository->getCurrenciesNBU();
        Currency::import_currencies_nbu($currencies);

        return $this->returnResultRedirectWithMessage(true);
    }

}
