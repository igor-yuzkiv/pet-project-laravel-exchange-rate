<?php

namespace App\Forms;

use App\Repository\BankRepository;
use App\Repository\BanksOptionsRepository;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;

class BanksOptionsForm extends Form
{
    public function buildForm()
    {
        $BankRepository = new BankRepository();

        $this
            ->add("bank_id", "select", [
                "label" => __("label.Bank"),
                'choices' => $BankRepository->getForSelect(),
                'attr' => [
                    "class" => "select2",
                    "style" => "width:100%"
                ],
            ])
            ->add("base_url", "text", [
                "label" => __("label.banks_options.url"),
            ])
            ->add("parse_class", "text", [
                "label" => __("label.banks_options.parse_class"),
            ])
            ->add("result_selector", "text", [
                "label" => __("label.banks_options.result_selector"),
            ])
            ->add("date_query_param", "text", [
                "label" => __("label.banks_options.date_query_param"),
            ])
            ->add("date_format", "text", [
                "label" => __("label.banks_options.date_format"),
            ])
            ->add("replace_key_sale", "text", [
                "label" => __("label.banks_options.replace_key_sale"),
            ])
            ->add("replace_key_purchase", "text", [
                "label" => __("label.banks_options.replace_key_purchase"),
            ])
            ->add("replace_key_currency_code", "text", [
                "label" => __("label.banks_options.replace_key_currency_code"),
            ])
            ->add("request_method", "select", [
                "label" => __("label.banks_options.request_method"),
                'choices' => config("backend.forms.banks_options.query_options.method"),
                'attr' => [
                    "class" => "select2",
                    "style" => "width:100%"
                ],
            ])
            ->add("request_content_type", "select", [
                "label" => __("label.banks_options.request_content_type"),
                'choices' => config("backend.forms.banks_options.query_options.content_type"),
                'attr' => [
                    "class" => "select2",
                    "style" => "width:100%"
                ],
            ])
            ->add(__("label.buttons.save"), "submit");
    }
}
