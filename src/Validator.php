<?php

namespace Gamegos\JWT;

use Gamegos\JWS\Exception\JWSException;
use Gamegos\JWS\JWS;
use Gamegos\JWT\Exception\JWTExpiredException;
use Gamegos\JWT\Exception\JWTSignatureException;

class Validator
{
    private $jws;

    public function __construct(JWS $jws = null)
    {
        $this->jws = $jws ?: new JWS();
    }

    public function validate($jwtString, $key)
    {
        try {
            $jwsData = $this->jws->verify($jwtString, $key);
            $headers = $jwsData['headers'];
            $claims  = $jwsData['payload'];
        } catch (JWSException $e) {
            throw new JWTSignatureException($e->getMessage(), $e->getCode(), $e);
        }

        $token = new Token($claims, $headers, $jwtString);

        if ($token->isExpired()) {
            throw new JWTExpiredException('Token expired.', 0, null, $token);
        }

        return $token;

    }
}
