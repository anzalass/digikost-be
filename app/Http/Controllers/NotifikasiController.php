<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Http\Requests\NotifikasiRequest;

class NotifikasiController extends Controller
{
    public function TambahLihatNotifikasiAdmin(NotifikasiRequest $Request){
        try{
            $TambahNotifikasi = Notifikasi::create([
                'idAdmin' => $Request->idAdmin,
                'status' => 1
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function TambahLihatNotifikasiOwner(NotifikasiRequest $Request){
        try{
            $TambahNotifikasi = Notifikasi::create([
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
            $findNotifikasiUser = Notifikasi::where('idAktivitas', $idAktivitas)->where('idOwner', '==', $idUser)->orWhere('idAdmin', $idUser)->get();

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
    public function DeleteNotifikasiById($id){
        try {
            //code...
            $nofifikasi = Notifikasi::where('id',$id)->first();
            if ($nofifikasi) {
                $nofifikasi->delete();
            }
            return response()->json([
                'message' =>"Notifikasi berhasil dihapus."
            ],200);
        } catch (\Exception $e) {
            //throw $th;
    
            return response()->json([
                'message'=> $e
            ],500);
        }
    }
}



