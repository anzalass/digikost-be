<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = 'notifikasis';
    protected $fillable = [
        'id',
        'untuk',
        'id_kegiatan',
        'id_pembuat',
        'nama_pembuat',
        'role_pembuat',
        'tipe',
        'status',
        'keterangan',
        'url',
        'created_at',
        'updated_at'
];
}
