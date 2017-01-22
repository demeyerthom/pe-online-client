<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22-1-17
 * Time: 14:23
 */

namespace Demeyerthom\PeOnline;


class ModelFactory
{
    public static function create($class, array $variables = [])
    {
        $model = new $class();
        foreach ($variables as $key => $variable) {
            $model->$key = $variable;
        }
        return $model;
    }

}