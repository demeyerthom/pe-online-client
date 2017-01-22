<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:50
 */

namespace Demeyerthom\PeOnline\Models;


class Error extends AbstractModel
{
    protected $attributes = [
        'errorNR' => null,
        'errorMsg' => null
    ];

}