<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:49
 */

namespace Demeyerthom\PeOnline\Models;


class Results extends AbstractModel
{
    protected $attributes = [
        'rejected_rows' => 0,
        'accepted_rows' => 0,
        'total_rows' => 0
    ];
}