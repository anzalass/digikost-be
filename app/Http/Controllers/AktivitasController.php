<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;

class AktivitasController extends Controller
{
    public function getAllAktivitas(){
        $AllAktivitas = Aktivitas::All();

        return response()->json([
            'results' => $AllAktivitas
        ],200);
    }
}
