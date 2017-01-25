<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22-1-17
 * Time: 14:46
 */

namespace Demeyerthom\PeOnline\Models;


use Demeyerthom\PeOnline\Exceptions\NotClassPropertyException;

class Model
{
    protected $attributes = [];

    protected $datetime = [];

    public function __construct($variables = [])
    {
        foreach ($variables as $key => $variable) {
            $this->$key = $variable;
        }
    }

    public function __get($name)
    {
        $method_name = "get$name";

        if (!key_exists($name, $this->attributes)) {

            throw new NotClassPropertyException("$name is not a property of " . get_class($this));
        }

        if (method_exists($this, $method_name)) {
            return $this->$method_name;
        }

        if (key_exists($name, $this->datetime)) {
            return new \DateTime($this->attributes[$name]);
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
            return $this->$method_name($value);
        }

        if (in_array($name, $this->datetime) and !$value instanceof \DateTime) {
            return $this->attributes[$name] = new \DateTime($value);
        }

        return $this->attributes[$name] = $value;
    }

    /**
     * Returns a filtered array representation of the resource.
     *
     * Note that all date fields are transformed to the ATOM-format.
     * However because PHP sucks with milliseconds, these are tacked on...
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = $this->attributes;
        foreach ($this->datetime as $datetime) {
            $attributes[$datetime] = $attributes[$datetime]->format('Y-m-d\TH:i:s.0000000P');
        }

        return array_filter($attributes);
    }

}