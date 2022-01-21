<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelUsers extends Model
{
  protected $table = "users";
  protected $primaryKey = "id";
  protected $allowedFields = ["email", "password"];

  function getEmail($email)
  {
    $data = $this->where("email", $email)->first();

    if (!$data) {
      throw new Exception("Email tidak ditemukan");
    }

    return $data;
  }
}
