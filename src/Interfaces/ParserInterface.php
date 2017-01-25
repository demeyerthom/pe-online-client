<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 20:18
 */

namespace Demeyerthom\PeOnline\Interfaces;

use Demeyerthom\PeOnline\Models\Summary;

interface ParserInterface
{
    public function createRequestString(array $settings, $attendances);

    public function parseSummary(string $summaryString): Summary;
}