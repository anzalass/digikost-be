<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CekNotifikasi;
use App\Http\Requests\CekNotifikasiRequest;

class CekNotifikasiController extends Controller
{
    public function TambahLihatNotifikasiAdmin(CekNotifikasiRequest $Request){
        try{
            $TambahNotifikasi = CekNotifikasi::create([
                'idAdmin' => $Request->idAdmin,
                'status' => 1
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function TambahLihatNotifikasiOwner(CekNotifikasiRequest $Request){
        try{
            $TambahNotifikasi = CekNotifikasi::create([
                'idOwner' => $Request->idOwner,
                'status' => 1
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function FindNotifikasiByIdUser($idUser, $idAktivitas, $role){
        try{
            $findNotifikasiUser = CekNotifikasi::where('idAktivitas', $idAktivitas)->where('idOwner', '==', $idUser)->orWhere('idAdmin', $idUser)->get();

            if(count($findNotifikasiUser) != 0){
                return response()->json([
                    'message' => "Data Notifikasi Sudah Ada"
                ],200);
            }

            return response()->json([
                'Messages' => "Data Notifikasi Belum Ada"
            ],404);

        }catch(Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }
}
