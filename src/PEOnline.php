<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26-1-17
 * Time: 22:36
 */

namespace Demeyerthom\PeOnline;

use Illuminate\Support\Facades\Facade;

class PEOnline extends Facade
{
    protected static function getFacadeAccessor() { return 'pe-online'; }
}