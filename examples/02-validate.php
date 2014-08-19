<?php
require_once __DIR__ . '/../vendor/autoload.php';

$jwtString = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzb21lb25lQGV4YW1wbGUuY29tIiwiZXhwIjoxNDA4NDI2OTUyfQ.4gRgjKF5oe32qtGhhezuqQu9tvZ70h6qzZDFUzSKJRw';

$key = 'some-secret-for-hmac';

$validator = new \Gamegos\JWT\Validator();
$token = $validator->validate($jwtString, $key);

print_r($token->getClaims());
print_r($token->getHeaders());
