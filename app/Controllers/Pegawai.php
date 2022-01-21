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

  public function index()
  {
    $response = [
      "status" => 200,
      "message" => [
        "success" => "Data Pegawai",
      ],
      "result" => $this->model->orderBy("nama", "ASC")->findAll()
    ];

    return $this->respond($response);
  }

  public function show($id = null)
  {
    $data = $this->model->find($id);

    if (!$data) {
      return $this->failNotFound("Pegawai dengan ID {$id} tidak ditemukan");
    }

    return $this->respond([
      "status" => 200,
      "message" => [
        "success" => "Data Pegawai",
      ],
      "result" => $data
    ]);
  }

  public function create()
  {
    $data = $this->request->getPost();

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    };

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
