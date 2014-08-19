<?php

namespace Gamegos\JWT;

use Gamegos\JWS\JWS;

class Validator
{
    private $jws;

    public function __construct(JWS $jws = null)
    {
        $this->jws = $jws ?: new JWS();
    }

    public function validate($jwtString, $key)
    {
        $jwsString = $this->jws->decode($jwtString, $key);

        $headers = $jwsString['headers'];
        $claims  = $jwsString['payload'];

        $token = new Token($claims, $headers, $jwtString);

        //check expire date
        return $token;

    }
}
