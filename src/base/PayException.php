<?php
namespace allinpayyst\base;

use Exception;

/**
 * 支付异常类
 */
class PayException extends Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}