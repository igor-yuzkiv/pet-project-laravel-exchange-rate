<?php

namespace App\Http\Requests\Translator;

use Illuminate\Foundation\Http\FormRequest;

class TranslationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "locale" => "required",
            "namespace" => "required",
            "group" => "required",
            "item" => ["required", "unique:translator_translations,item"],
            "text" => "required",
        ];
    }
    public function rules_update($id)
    {
        return [
            "locale" => "required",
            "namespace" => "required",
            "group" => "required",
            "item" => ["required", "unique:translator_translations,item,".$id],
            "text" => "required",
        ];
    }

}
