<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;
    
        protected $table = 'aktivitass';
        protected $fillable = [
        'id',
        'IdKategori',
        'IdPembuat',
        'IdPemeliharaan',
        'IdPengadaan',
        'IdRuang',
        'keterangan',
        'tipe',
        'created_at',
        'updated_at'
    ];
}
