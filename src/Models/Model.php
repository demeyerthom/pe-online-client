<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22-1-17
 * Time: 14:46
 */

namespace Demeyerthom\PeOnline\Models;

class Model
{
    public function toArray(): array
    {
        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties();
        $values = [];
        foreach ($props as $prop) {
            $name = $prop->name;
            $values[$name] = $this->$name;
        }
        return $values;
    }
}