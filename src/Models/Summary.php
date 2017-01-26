<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:49
 */

namespace Demeyerthom\PeOnline\Models;

use Demeyerthom\PeOnline\Interfaces\SummaryInterface;

class Summary extends Model implements SummaryInterface
{
    protected $errors = [];
    protected $accepted = [];

    /**
     * @return mixed
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function addError(Error $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return mixed
     */
    public function getAccepted(): array
    {
        return $this->accepted;
    }

    /**
     * @param mixed $accepted
     */
    public function addAccepted(Accepted $accepted)
    {
        $this->accepted[] = $accepted;
    }

    public function getErrorCount(): int
    {
        return count($this->errors);
    }

    public function getAcceptedCount(): int
    {
        return count($this->accepted);
    }

    public function getTotalCount(): int
    {
        return $this->getAcceptedCount() + $this->getErrorCount();
    }

}