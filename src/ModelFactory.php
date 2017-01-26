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
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            $model->$method($field);
        }
        return $model;
    }

    /**
     * @param $class
     * @param $instances
     * @return Collection
     */
    public function createMultiple($class, $instances): array
    {
        $collection = [];
        foreach ($instances as $fields) {
            $collection[] = $this->create($class, $fields);
        }
        return $collection;
    }
}