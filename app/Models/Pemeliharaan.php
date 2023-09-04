<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pemeliharaan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'kodePemeliharaan';
    protected $fillable = [
        'kodePemeliharaan',
        'kodeBarang',
        'kodeRuang',
        'idUser',
        'jumlah',
        'buktiPembayaran',
        'status',
        'harga',
    ];
}
