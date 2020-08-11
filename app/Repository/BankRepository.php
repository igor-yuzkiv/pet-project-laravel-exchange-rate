<?php

namespace App\Repository;

use App\Model\Bank as Model;

/**
 * Class BankRepository
 * @package App\Repository
 */
class BankRepository extends CoreRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param string $keyAttr
     * @param string $valueAttr
     * @param string $sortColumn
     * @param string $sortMethod
     * @return mixed
     */
    public function getForSelectForm($keyAttr = "id", $valueAttr = "name", $sortColumn = "banks.created_at", $sortMethod = "DESC")
    {
        $result = $this->startCondition()
            ->select(["banks.id", "banks.name"])
            ->orderBy($sortColumn, $sortMethod)
            ->leftJoin("banks_options", "banks.id", "bank_id")
            ->whereNull("banks_options.bank_id")
            ->get()
            ->pluck($valueAttr, $keyAttr)
            ->toArray();

        return $result;
    }


    /**
     * @param array $columns
     * @return mixed
     */
    public function getEnabledBanks($columns = ["*"]) {
        $result = $this->startCondition()
            ->select($columns)
            ->where("is_enable", 1)
            ->get();

        return $result;
    }

}
