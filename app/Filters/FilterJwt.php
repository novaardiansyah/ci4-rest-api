<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use Config\Services;
use Exception;

class FilterJwt implements FilterInterface
{
  use ResponseTrait;

  public function before(RequestInterface $request, $arguments = null)
  {
    $header = $request->getServer("HTTP_AUTHORIZATION");

    try {
      helper("jwt");
      $encodedToken = getJWT($header);
      validateJWT($encodedToken);

      return $request;
    } catch (Exception $err) {
      return Services::response()->setJSON([
        "status" => "error",
        "message" => $err->getMessage()
      ])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // do something here
  }
}
