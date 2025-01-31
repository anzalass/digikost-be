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
        'id_kegiatan',
        'id_pembuat',
        'nama_pembuat',
        'role_pembuat',
        'tipe',
        'keterangan',
        'url',
        'created_at',
        'updated_at'
    ];
}
