<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekNotifikasi extends Model
{
    use HasFactory;
    protected $table = 'ceknotifikasis';
    protected $fillable = [
    'id',
    'idAdmin',
    'idOwner',
    'idAktivitas',
    'target',
    'status'
];
}
