<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 15:39
 */

namespace Demeyerthom\PeOnline;


class ModelFactory
{
    public static function create($class, array $variables = [])
    {
        $model = new $class;
        foreach ($variables as $key => $variable) {
            $model->$key = $variable;
        }
        return $model;
    }
}