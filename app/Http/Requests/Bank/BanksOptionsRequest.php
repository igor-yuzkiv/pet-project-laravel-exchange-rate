<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class BanksOptionsRequest extends FormRequest
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
            "bank_id" => "required|unique:banks_options,bank_id",
            "base_url" => "required",
            "result_selector" => "",
            "date_query_param" => "",
            "date_format" => "",
            "replace_key_sale" => "",
            "replace_key_purchase" => "",
            "replace_key_currency_code" => "",
            "request_method" => "",
            "request_content_type" => "",
        ];
    }

    public function rules_update($id)
    {
        return [
            "bank_id" => "required|unique:banks_options,bank_id,{$id}",
            "base_url" => "required",
            "result_selector" => "",
            "date_query_param" => "",
            "date_format" => "",
            "replace_key_sale" => "",
            "replace_key_purchase" => "",
            "replace_key_currency_code" => "",
            "request_method" => "",
            "request_content_type" => "",
        ];
    }

}
