<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 20:17
 */

namespace Demeyerthom\PeOnline\Interfaces;

interface ClientInterface
{
    public function postAttendance(string $xml): string;
}