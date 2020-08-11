<?php

namespace App\Forms;

use App\Repository\Translator\LanguageRepository;
use App\Repository\Translator\TranslationRepository;
use Kris\LaravelFormBuilder\Form;

class TranslationsForm extends Form
{
    public function buildForm()
    {
        $LanguagesRepository = new LanguageRepository();

        $this
            ->add('locale', 'select', [
                "label" => __("label.translations.attr.locale"),
                'choices' => $LanguagesRepository->getForSelect("name"),
                'selected' => config("app.locale"),
            ])
            ->add('namespace', 'text', [
                "label" => __("label.translations.attr.namespace"),
                "value" => "*"
            ])
            ->add('group', 'text', [
                "label" => __("label.translations.attr.group"),
            ])
            ->add('item', 'text', [
                "label" => __("label.translations.attr.item"),
            ])
            ->add('text', 'text', [
                "label" => __("label.translations.attr.text"),
            ])
            ->add(__("label.buttons.save"), "submit", [
                "attr" => [
                    "class" => "form-control btn btn-success"
                ]
            ]);
    }
}
