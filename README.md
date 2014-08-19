PHP JSON Web Token (JWT) Library
====================================

JSON Web Token (JWT) implementation based on [draft-ietf-oauth-json-web-token-25](http://tools.ietf.org/html/draft-ietf-oauth-json-web-token-25).


## Installation


The recommended way to install gamegos/jws is through [Composer](http://getcomposer.org).

```JSON
{
    "require": {
        "gamegos/jwt": "~0.1"
    }
}
```


## Basic Usage

Encoding

```php
$key = 'some-secret-for-hmac';
$alg = 'HS256';

$token = new \Gamegos\JWT\Token();
$token->setClaim('sub', 'someone@example.com'); // alternatively you can use $token->setSubject('someone@example.com') method
$token->setClaim('exp', time() + 60*5);

$encoder = new \Gamegos\JWT\Encoder();
$encoder->encode($token, $key, $alg);

printf("JWT TOKEN: %s\n", $token->getJWT()); //eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzb21lb25lQGV4YW1wbGUuY29tIiwiZXhwIjoxNDA4NDUzNzkwfQ.2Fk5-UUMhOAcQH812LL0sdaf29zuf293nLhHp_VKBDg


```


Validation

```php

$jwtString = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzb21lb25lQGV4YW1wbGUuY29tIiwiZXhwIjoxNDA4NDUyMzcxfQ.Fy1DLdfZBiR_khyTsghItDW3_1rM7osz_IxjiaiRto0';

$key = 'some-secret-for-hmac';


try {
    $validator = new \Gamegos\JWT\Validator();
    $token = $validator->validate($jwtString, $key);

    print_r($token->getClaims());
    print_r($token->getHeaders());
} catch (\Gamegos\JWT\Exception\JWTException $e) {
    printf("Invalid Token:\n  %s\n", $e->getMessage());
    //$e->getToken();
}
```

See [examples](https://github.com/Gamegos/php-jwt/tree/master/examples) folder for sample code.


## Supported Signature Algorithms

This package uses ```gamegos/jws``` for signing tokens. Currently supported signature and mac algorithms:

- *HS256*, *HS384*, *HS512* (HMAC using SHA-XXX)
- *RS256*, *RS384*, *RS512* (RSASSA-PKCS-v1_5 using SHA-XXX)

Details can be found [here.](https://github.com/Gamegos/php-jws#algorithms)
