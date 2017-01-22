<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22-1-17
 * Time: 14:46
 */

namespace Demeyerthom\PeOnline\Models;


use Demeyerthom\PeOnline\Exceptions\NotClassPropertyException;

class AbstractModel
{
    protected $attributes = [];

    public function __get($name)
    {
        $method_name = "get$name";

        if (!key_exists($name, $this->attributes)) {
            throw new NotClassPropertyException("$name is not a property of " . get_class($this));
        }

        if (method_exists($this, $method_name)) {
            return $this->$method_name;
        }

        return $this->attributes[$name];
    }

    public function __set($name, $value)
    {
        $method_name = "set$name";

        if (!key_exists($name, $this->attributes)) {
            throw new NotClassPropertyException("$name is not a property of " . get_class($this));
        }

        if (method_exists($this, $method_name)) {
            $this->$method_name($value);
        } else {
            $this->attributes[$name] = $value;
        }
    }

}