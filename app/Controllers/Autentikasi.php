<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelUsers;

class Autentikasi extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    $validation = \Config\Services::validation();
    $rules = [
      "email" => [
        "rules" => "required|valid_email",
        "errors" => [
          "required" => "Email tidak boleh kosong",
          "valid_email" => "Email tidak valid"
        ]
      ],
      "password" => [
        "rules" => "required",
        "errors" => [
          "required" => "Password tidak boleh kosong"
        ]
      ]
    ];

    $validation->setRules($rules);

    if (!$validation->withRequest($this->request)->run()) {
      return $this->fail($validation->getErrors());
    }

    $model = new ModelUsers();

    $email = $this->request->getPost("email");
    $password = $this->request->getPost("password");

    $data = $model->getEmail($email);

    if (!password_verify($password, $data["password"])) {
      return $this->fail("Email atau password salah");
    }

    helper("jwt");

    $response = [
      "status" => 200,
      "error" => null,
      "message" => [
        "success" => "Login berhasil"
      ],
      "result" => [
        "id" => $data["id"],
        "email" => $data["email"],
        "password" => $data["password"],
        "access_token" => createJWT($data["email"])
      ]
    ];

    return $this->respond($response, 200);
  }
}
