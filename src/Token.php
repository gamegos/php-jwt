<?php

namespace Gamegos\JWT;

class Token
{
    private $jwtString = null;

    private $claims = array();

    private $headers = array(
        'typ' => 'JWT'
    );

    public function __construct(array $claims = array(), array $headers = array(), $jwtString = null)
    {
        $this->setClaims($claims);
        $this->setHeaders($headers);
        if ($jwtString) {
            $this->setJWT($jwtString);
        }
    }

    //claims

    public function getClaims()
    {
        return $this->claims;
    }

    public function setClaims($claims)
    {
        foreach ($claims as $claim => $value) {
            $this->setClaim($claim, $value);
        }
    }

    public function getClaim($claim)
    {
        return $this->hasClaim($claim) ? $this->claims[$claim] : null;
    }

    public function setClaim($claim, $value)
    {
        $this->claims[$claim] = $value;
    }

    public function hasClaim($claim)
    {
        return isset($this->claims[$claim]);
    }

    //headers

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders($headers)
    {
        foreach ($headers as $header => $value) {
            $this->setHeader($header, $value);
        }
    }

    public function getHeader($header)
    {
        return $this->hasHeader($header) ? $this->headers[$header] : null;
    }

    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function hasHeader($header)
    {
        return isset($this->headers[$header]);
    }

    public function setJWT($jwtString)
    {
        $this->jwtString = $jwtString;
    }

    public function getJWT()
    {
        return $this->jwtString;
    }

    public function __toString()
    {
        return (string) $this->getJWT();
    }

    public function isSigned()
    {
        return $this->jwtString !== null;
    }

    public function isExpired()
    {
        $exp = $this->getClaim('exp');

        return time() > $exp;
    }

    // "Long" getters and setters for *Registered Claim Names* defined in
    // http://tools.ietf.org/html/draft-ietf-oauth-json-web-token-25#section-4.1

    public function getIssuer()
    {
        return $this->getClaim("iss");
    }

    public function setIssuer($val)
    {
        $this->setClaim("iss", $val);
    }

    public function getSubject()
    {
        return $this->getClaim("sub");
    }

    public function setSubject($val)
    {
        $this->setClaim("sub", $val);
    }

    public function getAudience()
    {
        return $this->getClaim("aud");
    }

    public function setAudience($val)
    {
        $this->setClaim("aud", $val);
    }

    public function getExpirationTime()
    {
        return $this->getClaim("exp");
    }

    public function setExpirationTime($val)
    {
        $this->setClaim("exp", $val);
    }

    public function getNotBefore()
    {
        return $this->getClaim("nbf");
    }

    public function setNotBefore($val)
    {
        $this->setClaim("nbf", $val);
    }

    public function getIssuedAt()
    {
        return $this->getClaim("iat");
    }

    public function setIssuedAt($val)
    {
        $this->setClaim("iat", $val);
    }

    public function getJWTID()
    {
        return $this->getClaim("jti");
    }

    public function setJWTID($val)
    {
        $this->setClaim("jti", $val);
    }

}
