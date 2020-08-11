<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class BankForm extends Form
{
    public function buildForm()
    {
        $this
            ->add("name", "text", [
                "label" => __("label.name_bank")
            ])
            ->add("alias", "text", [
                "label" => __("label.alias_bank")
            ])
            ->add("bank_logo", "file", [
                "label" => __("label.logo"),
                "attr" => [
                    "accept" => "image/jpeg,image/png"
                ]
            ])
            ->add("Save", "submit");

    }
}
