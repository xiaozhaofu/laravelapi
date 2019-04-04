<?php
/**
 * Created by PhpStorm.
 * User: Hasee
 * Date: 2019/4/4
 * Time: 15:52
 */
namespace App\Exceptions;

use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct(array $apiErrConst, Throwable $previous = null)
    {
        $code=$apiErrConst[0];
        $message=$apiErrConst[1];
        parent::__construct($message, $code, $previous);
    }
}