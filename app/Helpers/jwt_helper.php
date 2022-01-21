<?php

use App\Models\ModelUsers;
use Firebase\JWT\JWT;

function createJWT($email)
{
  $requestTime = time();
  $tokenTime = getenv("JWT_TIME_TO_LIVE");
  $expiredTime = $requestTime + $tokenTime;

  $payload = [
    "email" => $email,
    "iat" => $requestTime,
    "exp" => $expiredTime
  ];

  $jwt = JWT::encode($payload, getenv("JWT_SECRET_KEY"));

  return $jwt;
}

function getJWT($usersHeader)
{
  if (is_null($usersHeader)) {
    throw new Exception("Autentikasi gagal");
  }

  return explode(" ", $usersHeader)[1];
}

function validateJWT($encodedToken)
{
  $key = getenv("JWT_SECRET_KEY");
  $decodedToken = JWT::decode($encodedToken, $key, array("HS256"));

  $modelUsers = new ModelUsers();

  $modelUsers->getEmail($decodedToken->email);
}
