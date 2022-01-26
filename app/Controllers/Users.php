<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelUsers;

class Users extends BaseController
{
  use ResponseTrait;

  function __construct()
  {
    $this->model = new ModelUsers();
  }

  public function create()
  {
    $email = $this->request->getPost("email");
    $password = $this->request->getPost("password");

    $data = [
      "email" => $email,
      "password" => password_hash($password, PASSWORD_DEFAULT)
    ];

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    };

    $response = [
      "status" => 201,
      "error" => null,
      "message" => [
        "success" => "Data berhasil ditambahkan"
      ],
      "result" => $this->model->find($this->model->insertID)
    ];

    return $this->respond($response, 201);
  }
}
