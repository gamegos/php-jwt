<?php
require_once __DIR__ . '/../vendor/autoload.php';

$key = 'some-secret-for-hmac';
$alg = 'HS256';

$token = new \Gamegos\JWT\Token();
$token->setClaim('sub', 'someone@example.com');
$token->setClaim('exp', time() + 60*5);

$encoder = new \Gamegos\JWT\Encoder();
$encoder->encode($token, $key, $alg);

printf("JWT TOKEN: %s\n", $token->getJWT());
print_r($token->getClaims());
print_r($token->getHeaders());
