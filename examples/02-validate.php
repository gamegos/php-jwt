<?php
require_once __DIR__ . '/../vendor/autoload.php';

$jwtString = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzb21lb25lQGV4YW1wbGUuY29tIiwiZXhwIjoxNDA4NDUyMzcxfQ.Fy1DLdfZBiR_khyTsghItDW3_1rM7osz_IxjiaiRto0';

$key = 'some-secret-for-hmac';


try {
    $validator = new \Gamegos\JWT\Validator();
    $token = $validator->validate($jwtString, $key);

    print_r($token->getClaims());
    print_r($token->getHeaders());
} catch (\Gamegos\JWT\Exception\JWTException $e) {
    printf("Invalid Token:\n  %s\n", $e->getMessage());
    //var_dump($e->getToken());
}