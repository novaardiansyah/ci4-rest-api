<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
  protected $table = "pegawai";
  protected $primaryKey = "id";
  protected $allowedFields = ["nama", "email", "alamat"];
}
