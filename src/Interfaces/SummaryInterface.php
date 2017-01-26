<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26-1-17
 * Time: 22:31
 */

namespace Demeyerthom\PeOnline\Interfaces;

use Demeyerthom\PeOnline\Models\Accepted;
use Demeyerthom\PeOnline\Models\Error;

interface SummaryInterface
{
    public function getErrors(): array;

    public function addError(Error $error);

    public function getAccepted(): array;

    public function addAccepted(Accepted $accepted);

    public function getErrorCount(): int;

    public function getAcceptedCount(): int;

    public function getTotalCount(): int;
}