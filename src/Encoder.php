<?php

namespace Gamegos\JWT;

use Gamegos\JWS\JWS;

class Encoder
{
    private $jws;

    public function __construct(JWS $jws = null)
    {
        $this->jws = $jws ?: new JWS();
    }

    public function encode(Token $token, $key, $algorithm = null)
    {
        if ($algorithm === null && !$token->hasHeader('alg')) {
            throw new \LogicException('Algorithm must be specified.');
        }

        if (!$token->hasHeader('alg')) {
            $token->setHeader('alg', $algorithm);
        }

        $jwtString = $this->jws->encode($token->getHeaders(), $token->getClaims(), $key);
        $token->setJWT($jwtString);

        return $jwtString;
    }
}
