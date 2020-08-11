<?php

namespace App\Repository;

use App\Model\BanksOptions as Model;

class BanksOptionsRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }


    /**
     * @param $id
     * @return array|null
     */
    public function getQueryAttributesById($id) {
        $result = $this->getForEdit($id);
        $result = $result->getAttribute("query_attributes");
        return $result;
    }
}
