<?php

namespace App\Http\Controllers\Backend\Translator;

use App\Forms\TranslationsForm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ControllerTrait;
use App\Http\Requests\Translator\TranslationsRequest;
use App\Repository\Translator\TranslationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kris\LaravelFormBuilder\FormBuilder;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Models\Translation;

class TranslationsController extends Controller
{
    use ControllerTrait;

    /**
     * @var TranslationRepository
     */
    private $TranslationsRepository;

    /**
     * TranslationsController constructor.
     */
    public function __construct()
    {
        $this->TranslationsRepository = app(TranslationRepository::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dataTable = $this->TranslationsRepository->getAll();

        return view("Backend.translator.translations.index", [
            "title" => __("title.translator.translations.index"),
            "dataTable" => $dataTable,
        ]);
    }

    /**
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TranslationsForm::class, [
            "method" => "POST",
            "url" => route("backend.translator.translations.store")
        ]);

        return view($this->viewSimpleForm, [
            "form" => $form,
            "title" => __("title.translator.translations.create"),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TranslationsRequest $request)
    {
        $result = $this->TranslationsRepository->store($request->except("_token"));
        return  $this->returnResultRedirectWithMessage($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TranslationsForm::class, [
            "method" => "PUT",
            "url" => route("backend.translator.translations.update", $id),
            "model" => $this->TranslationsRepository->getForEdit($id)
        ]);

        return view($this->viewSimpleForm, [
            "form" => $form,
            "title" => __("title.translator.translations.edit"),
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->input(), (new TranslationsRequest()) -> rules_update($id));

        $result = $this->TranslationsRepository->store($request->except("_token"), $id);
        return  $this->returnResultRedirectWithMessage($result, "backend.translator.translations.index");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $result = Translation::destroy($id);
        return  $this->returnResultRedirectWithMessage($result);
    }
}
