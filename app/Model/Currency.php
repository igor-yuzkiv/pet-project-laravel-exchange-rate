<?php

namespace App\Model;

use App\Model\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * @package App\Model
 */
class Currency extends Model
{
    use ModelTrait;

    protected $table = "currencies";
    protected $keyType = 'string';
    /**
     * @var string
     */
    protected $primaryKey = "code";

    /**
     * @var array
     */
    protected $fillable = [
        "code",
        "currency_name",
        "country",
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchange_rates() {
        return $this->hasMany(ExchangeRate::class, "bank_id", "id");
    }

    public static function import_currencies_nbu(array $data) {
       if ( !empty($data) ) {
           foreach ($data as $item) {
               if ($item['cc'] !== null) {
                   $item = [
                       "code" => $item["cc"],
                       "currency_name" => $item["txt"] ?? null,
                   ];
                   Currency::updateOrCreate([ "code" => $item['code'] ], $item);
               }
           }
       }
    }

}
