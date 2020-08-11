<?php


namespace App\Model\Traits;


use Illuminate\Database\Eloquent\Model;

/**
 * Trait ModelTrait
 * @package App\Model\Traits
 */
trait ModelTrait
{
    /**
     * @param array $requestInput
     * @param null $id
     * @param array $attributesName
     * @param string $idColumn
     * @return bool|mixed
     */
    public function store(array $requestInput, $id = null, array $attributesName = [], $idColumn = "id") {
        $model = $this->prepareModel($requestInput, $id, $attributesName, $idColumn);
        return $model->save();
    }


    /**
     * @param array $requestInput
     * @param null $id
     * @param array $attributesName
     * @param string $idColumn
     * @return Model
     */
    public function storeAndReturnModel(array $requestInput, $id = null, array $attributesName = [], $idColumn = "id") {
        $model = $this->prepareModel($requestInput, $id, $attributesName, $idColumn);
        $model->save();
        return  $model;
    }

    /**
     * @param array $requestInput
     * @param null $id
     * @param array $attributesName
     * @param string $idColumn
     * @return Model
     */
    protected function prepareModel (array $requestInput, $id = null, array $attributesName = [], $idColumn = "id") : Model {
        $model = clone  $this;

        if ($id != null) {
            $model = $this->where($idColumn, $id)->first();
        }

        $model->fill($requestInput);
        $model->setAttributes($model, $attributesName, $requestInput);

        return $model;
    }

    /**
     * @param Model $model
     * @param array $attributesName
     * @param array $requestInput
     */
    protected function setAttributes (Model &$model, array $attributesName, array $requestInput) {
        if (!empty($attributesName)) {
            foreach ($attributesName as $item) {
                if (isset($requestInput[$item])) {
                    $model->setAttribute($item, $requestInput[$item]);
                }
            }
        }
    }
}
