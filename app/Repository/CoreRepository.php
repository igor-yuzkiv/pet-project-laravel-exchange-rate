<?php


namespace App\Repository;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 * @package App\Repository
 */
abstract class CoreRepository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Application|Model|mixed
     */
    protected function startCondition()
    {
        return clone $this->model;
    }

    /**
     * @param string $keyAttr
     * @param string $valueAttr
     * @param string $sortColumn
     * @param string $sortMethod
     * @return mixed
     */
    public function getForSelect($keyAttr = "id", $valueAttr = "name", $sortColumn = "created_at", $sortMethod = "DESC")
    {
        $result = $this->startCondition()
            ->orderBy($sortColumn, $sortMethod)
            ->get()
            ->pluck($valueAttr, $keyAttr)
            ->toArray();

        return $result;
    }

    /**
     * @param $id
     * @param array $columns
     * @param string $idColumn
     * @return mixe
     */
    public function getForEdit($id, $columns = ["*"], $idColumn = "id")
    {
        $result = $this->startCondition()
            ->select($columns)
            ->where($idColumn, $id)
            ->first();

        return $result;
    }

    /**
     * @param array $columns
     * @param string $sortColumn
     * @param string $sortMethod
     * @param bool $toBase
     * @return mixed
     */
    public function getAll(Array $columns = ["*"], $sortColumn = "created_at", $sortMethod = "DESC", bool $toBase = true)
    {
        $result = $this->startCondition()
            ->select($columns)
            ->orderBy($sortColumn, $sortMethod);
        if ($toBase) {
            $result = $result->toBase();
        }

        $result = $result->get();

        return $result;
    }
}
