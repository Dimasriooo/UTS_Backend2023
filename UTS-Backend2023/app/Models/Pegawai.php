<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Mendefinisikan nama attributes table yang digunakan
    protected $fillable = ["name", "gender","phone", "email", "alamat", "status", "hired_on"];
}
