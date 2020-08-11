<?php

namespace App\Model;

use App\Filters\ExchangeRateFilter;
use App\Model\Traits\ModelTrait;
use App\Repository\ExchangeRateRepository;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class ExchangeRate
 * @package App\Model
 */
class ExchangeRate extends Model
{
    use Filterable, ExchangeRateFilter, ModelTrait;

    protected $table = "exchange_rate";

    /**
     * @var array
     */
    private static $whiteListFilter = [
        "date_between",
        "currency_code",
        "bank_id"
    ];

    /**
     * @var array
     */
    protected $fillable = [
        "currency_code",
        "bank_id",
        "sale",
        "purchase",
        "date"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bank () {
        return $this->hasOne(Bank::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currency() {
        return $this->hasOne(Currency::class, 'code', 'currency_code');
    }

    /**
     * @param array $data
     * @param int $bank_id
     * @param string $date
     * @return array
     * @throws \Exception
     */
    public function massStoreByBank(array $data, int $bank_id, string $date) : array {
        $ExchangeRateRepository = new ExchangeRateRepository();

        $result = array();
        foreach ($data as $item) {
            $check = $ExchangeRateRepository->checkIssetRate($date, $item["currency_code"], $bank_id);
            if ($check === true) {
                $model = clone $this;
                $item["bank_id"] = $bank_id;
                $item["date"] = $date;
                $saved = $model->store($item);
                $result[$item["currency_code"]] = $saved;
            }else {
                $result[$item["currency_code"]] = false;
            }
        }

        return $result;
    }
}
