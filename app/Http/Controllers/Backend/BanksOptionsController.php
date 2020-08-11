<?php

namespace App\Http\Controllers\Backend;

use App\Forms\BanksOptionsForm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ControllerTrait;
use App\Http\Requests\Bank\BanksOptionsRequest;
use App\Model\BanksOptions;
use App\Repository\BanksOptionsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kris\LaravelFormBuilder\FormBuilder;

/**
 * Class BanksOptionsController
 * @package App\Http\Controllers\Backend
 */
class BanksOptionsController extends Controller
{

    use ControllerTrait;

    /**
     * @var BanksOptionsRepository
     */
    private $BanksOptionsRepository;

    /**
     * BanksOptionsController constructor.
     */
    public function __construct()
    {
        $this->BanksOptionsRepository = app(BanksOptionsRepository::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(BanksOptionsForm::class, [
            "method" => "POST",
            "url" => route("backend.banks-options.store")
        ]);

        return view($this->viewSimpleForm, [
            "title" => "Bank Option crete",
            "form" => $form,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BanksOptionsRequest $request)
    {
        $banksOptionModel = new BanksOptions();
        $result = $banksOptionModel->store($request->input(), null);
        return $this->returnResultRedirectWithMessage($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $bank_options = $this->BanksOptionsRepository->getForEdit($id);

        $form = $formBuilder->create(BanksOptionsForm::class, [
            "method" => "PUT",
            "url" => route("backend.banks-options.update", $bank_options->id),
            "model" => $bank_options
        ]);


        return view($this->viewSimpleForm, [
            "title" => "Bank Option crete",
            "form" => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->input(), (new BanksOptionsRequest())->rules_update($id)) -> validate();

        $banksOptionModel = new BanksOptions();
        $result = $banksOptionModel->store($request->input(), $id);
        return $this->returnResultRedirectWithMessage($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $result = (new BanksOptions()) -> destroy($id);
        return $this->returnResultRedirectWithMessage($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function query_attributes($id) {
        $queryAttributes = $this->BanksOptionsRepository->getQueryAttributesById($id);

        return view("Backend.banks_options.form_query_attributes", [
            "title" => __("label.query_attributes.title"),
            "queryAttributes" => $queryAttributes,
            "banks_options_id" => $id
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function query_attributes_store(Request $request, $id) {
        $result = (new BanksOptions()) -> store_query_attributes($id, $request->query_attributes);
        return $this->returnResultRedirectWithMessage($result);
    }

    /**
     * @param $id
     * @param $key
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function query_attributes_delete($id, $key) {
        $result = (new BanksOptions()) -> delete_query_attributes($id, $key);
        return $this->returnResultRedirectWithMessage($result);
    }

}
