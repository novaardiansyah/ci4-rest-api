<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPegawai;

class Pegawai extends BaseController
{
  use ResponseTrait;

  function __construct()
  {
    $this->model = new ModelPegawai();
  }

  public function create()
  {
    if (!$this->validate([
      "nama" => [
        "rules" => "required|min_length[3]",
        "errors" => [
          "required" => "Nama tidak boleh kosong",
          "min_length" => "Nama minimal 3 karakter"
        ]
      ],
      "email" => [
        "rules" => "required|valid_email",
        "errors" => [
          "required" => "Email tidak boleh kosong",
          "valid_email" => "Email tidak valid"
        ]
      ],
      "alamat" => [
        "rules" => "required",
        "errors" => [
          "required" => "Alamat tidak boleh kosong"
        ]
      ]
    ])) {
      return $this->fail($this->validator->getErrors());
    }

    $this->model->save([
      "nama" => $this->request->getPost("nama"),
      "email" => $this->request->getPost("email"),
      "alamat" => $this->request->getPost("alamat")
    ]);

    $response = [
      "status" => 201,
      "error" => null,
      "message" => [
        "success" => "Data berhasil ditambahkan"
      ],
      "data" => $this->model->find($this->model->insertID())
    ];

    return $this->respond($response);
  }
}
