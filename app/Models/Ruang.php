<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Ruang extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'kodeRuang'; // Assuming 'kodeRuang' is the primary key
    public $incrementing = false; // If the primary key is not auto-incrementing
    
    protected $fillable = [
        'kodeRuang',
        'ruang',
    ];    
}