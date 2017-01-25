<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 15:39
 */

namespace Demeyerthom\PeOnline;


use Illuminate\Support\Collection;

class ModelFactory
{
    /**
     * @param $class
     * @param array $fields
     * @return mixed
     */
    public function create($class, array $fields = [])
    {
        $model = new $class;
        foreach ($fields as $key => $field) {
            $model->$key = $field;
        }
        return $model;
    }

    /**
     * @param $class
     * @param $instances
     * @return Collection
     */
    public function createMultiple($class, $instances): Collection
    {
        $collection = new Collection();
        foreach ($instances as $fields) {
            $collection->push($this->create($class, $fields));
        }
        return $collection;
    }
}