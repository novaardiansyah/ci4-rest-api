<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Validation;

class ModelPegawai extends Model
{
  protected $table = "pegawai";
  protected $primaryKey = "id";
  protected $allowedFields = ["nama", "email", "alamat"];

  protected $validationRules = [
    "nama" => "required|min_length[3]",
    "email" => "required|valid_email",
    "alamat" => "required"
  ];

  protected $validationMessages = [
    "nama" => [
      "required" => "Nama tidak boleh kosong",
      "min_length" => "Nama minimal 3 karakter"
    ],
    "email" => [
      "required" => "Email tidak boleh kosong",
      "valid_email" => "Email tidak valid"
    ],
    "alamat" => [
      "required" => "Alamat tidak boleh kosong"
    ]
  ];
}
