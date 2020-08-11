<?php

namespace App\Model;

use App\Model\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Validator;

/**
 * Class BanksOptions
 * @package App\Model
 */
class BanksOptions extends Model
{
    use ModelTrait;
    /**
     * @var string
     */
    protected $table = "banks_options";

    /**
     * @var array
     */
    protected $fillable = [
        "bank_id",
        "base_url",
        "result_selector",
        "date_query_param",
        "date_format",
        "replace_key_sale",
        "replace_key_purchase",
        "replace_key_currency_code",
        "request_method",
        "request_content_type",
        "parse_class"
    ];

    /**
     * @var array
     */
    protected $casts = [
        "query_attributes" => "array"
    ];

    /**
     * @return HasOne
     */
    public function banks()
    {
        return $this->hasOne(Bank::class, "id", "bank_id");
    }


    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function store_query_attributes($id, $data)
    {
        $model = $this->whereId($id)->first();

        $data["value"] = ($data['value'] == null) ? "" : $data["value"];

        $query_attributes =  $model->getAttribute("query_attributes") ?? [];
        $query_attributes += [ $data["key"] => $data["value"] ];

        $model->setAttribute("query_attributes", $query_attributes);
        return $model->save();
    }

    /**
     * @param $id
     * @param $key
     * @return mixed
     */
    public function delete_query_attributes($id, $key)
    {
        $model = $this->whereId($id)->first();

        $query_attributes =  $model->getAttribute("query_attributes");
        unset($query_attributes[$key]);

        $model->setAttribute("query_attributes", $query_attributes);
        return $model->save();
    }


}
