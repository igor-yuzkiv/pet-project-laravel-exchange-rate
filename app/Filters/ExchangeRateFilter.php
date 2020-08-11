<?php


namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait ExchangeRateFilter
{
    public function date_between(Builder $builder, $value)
    {
        $value = explode(' - ', $value);

        $value[0] = Carbon::createFromDate($value[0])->startOfDay()->toDateTimeString();
        $value[1] = Carbon::createFromDate($value[1])->endOfDay()->toDateTimeString();

        return $builder->whereBetween("exchange_rate.date", $value);
    }

    public function bank_id(Builder $builder, $value) {
        return ($value !== "%")
            ? $builder->where("bank_id", $value)
            : $builder;
    }

    public function currency_code(Builder $builder, $value) {
        return ($value !== "%")
            ? $builder->where("currency_code", $value)
            : $builder;
    }
}
