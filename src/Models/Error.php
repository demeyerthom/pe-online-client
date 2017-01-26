<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:50
 */

namespace Demeyerthom\PeOnline\Models;


class Error extends Model
{
    protected $errorNR;
    protected $errorMsg;

    /**
     * @return mixed
     */
    public function getErrorNR()
    {
        return $this->errorNR;
    }

    /**
     * @param mixed $errorNR
     */
    public function setErrorNR($errorNR)
    {
        $this->errorNR = $errorNR;
    }

    /**
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    /**
     * @param mixed $errorMsg
     */
    public function setErrorMsg($errorMsg)
    {
        $this->errorMsg = $errorMsg;
    }


}