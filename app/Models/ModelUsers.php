<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelUsers extends Model
{
  protected $table = "users";
  protected $primaryKey = "id";
  protected $allowedFields = ["email", "password"];

  protected $validationRules = [
    "email" => "required|valid_email",
    "password" => "required"
  ];

  protected $validationMessages = [
    "email" => [
      "required" => "Email tidak boleh kosong",
      "valid_email" => "Email tidak valid"
    ],
    "password" => [
      "required" => "Password tidak boleh kosong"
    ]
  ];

  function getEmail($email)
  {
    $data = $this->where("email", $email)->first();

    if (!$data) {
      throw new Exception("Email tidak ditemukan");
    }

    return $data;
  }
}
