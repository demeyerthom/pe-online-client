<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:51
 */

namespace Demeyerthom\PeOnline\Models;


class Accepted extends AbstractModel
{
    protected $attributes = [
        'person' => null,
        'course' => null,
        'date' => null
    ];
}