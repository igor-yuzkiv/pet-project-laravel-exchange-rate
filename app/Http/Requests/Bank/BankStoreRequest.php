<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class BankStoreRequest extends FormRequest
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
            "name" => "required",
            "alias" => "required|unique:banks,alias",
            "is_enable" => "boolean",
            "bank_logo" => 'mimes:jpg,jpeg,png|max:4096'
        ];
    }

    public function rules_update($id)
    {
        return [
            "name" => "required",
            "alias" => "required|unique:banks,alias,$id",
            "is_enable" => "boolean",
            "bank_logo" => 'mimes:jpg,jpeg,png|max:4096'
        ];
    }

}
