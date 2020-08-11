<?php

namespace App\Repository\Translator;

use App\Repository\CoreRepository;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Waavi\Translation\Models\Translation as Model;

class TranslationRepository extends CoreRepository
{
    use Filterable;

    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param array $requestInput
     * @param null $id
     * @param array $attributesName
     * @return mixed
     */
    public function store(array $requestInput, $id = null, array $attributesName = []) {
        $model = $this->startCondition();

        if ($id != null) {
            $model = $model->where("id", $id)->first();
        }
        $model->fill($requestInput);

        if (!empty($attributesName)) {
            foreach ($attributesName as $item) {
                $model->setAttribute($item, $requestInput[$item]);
            }
        }

        return $model->save();
    }
}
