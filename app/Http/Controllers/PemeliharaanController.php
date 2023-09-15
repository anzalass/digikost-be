<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemeliharaanRequest;
use Illuminate\Http\Request;

use App\Models\Pemeliharaan;

class PemeliharaanController extends Controller
{
    public function getPemeliharaan(){
        $Pemeliharaan = Pemeliharaan::all();

        return response()->json([
            'results' => $Pemeliharaan
        ],200);
    }

    public function tambahPemeliharaan(PemeliharaanRequest $request){
        try{
            Pemeliharaan::create([
                'kodeBarang'=> $request->kodeBarang,
                'kodeRuang'=> $request->kodeRuang,
                'idUser' => $request->idUser,
                'jumlah'=> $request->jumlah,
                'buktiPembayaran'=> $request->buktiPembayaran,
                'status'=> $request->status,
                'harga'=> $request->harga
            ]);
            return response()->json([
                'message' => 'Pemeliharaan Berhasil Ditambahkan'
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function hapusPemeliharaan($kodePemeliharaan){
        $findPemeliharaan = Pemeliharaan::where('kodePemeliharaan',$kodePemeliharaan)->first();

        if($findPemeliharaan){
            $findPemeliharaan->delete();
            return response()->json([
                'message' => 'Pemeliharaan Berhasil Dihapus'
            ],200);
        }else{
            return response()->json([
                'message' => 'Pemeliharaan tidak ditemukan'
            ],404);
        }
    }
}
