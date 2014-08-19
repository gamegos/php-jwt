<?php

namespace Gamegos\JWT\Exception;

use Gamegos\JWT\Token;

abstract class JWTException extends \RuntimeException
{
    protected $token;

    public function __construct($message = "", $code = 0, \Exception $previous = null, Token $token = null)
    {
        parent::__construct($message, $code, $previous);
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }
}
