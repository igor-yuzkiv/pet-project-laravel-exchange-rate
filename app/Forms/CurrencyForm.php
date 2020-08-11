<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CurrencyForm extends Form
{
    public function buildForm()
    {
        $this
            /*->add("code", "text", [
                "label" => __("label.currency_code")
            ])*/
            ->add("currency_name", "text", [
                "label" => __("label.currency_name")
            ])
            ->add("country", "text", [
                "label" => __("label.county")
            ])
            ->add(__("label.buttons.save"), "submit");
    }
}
