<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuangRequest;
use App\Models\Pengadaan;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index(){
        $ruang = Ruang::all();

        if($ruang){
            return response()->json([
                'results' => $ruang
            ],200);
        }

        return response()->json([
            'message' => 'Data Ruangan tidak ditemukan'
        ],404);
    }

    public function TambahRuang(RuangRequest $request){
        try{
            Ruang::create([
                'kodeRuang' => $request->kodeRuang,
                'namaRuang' => $request->namaRuang
            ]);
            return response()->json([
                'message' => 'Ruang Successfully created'
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],404);
        }
    }

    public function FindRuang($kodeRuang){
        $ruangan = Ruang::find($kodeRuang);

        if($ruangan){
            return response()->json([
                'results' => $ruangan
            ],200);
        }else{
            return response()->json([
                'message' =>"Ruang not found."
            ],404);
        }
    }

    public function UpdateRuang(RuangRequest $request, $kodeRuang, $namaRuang){
        try{
            $findRuang = Ruang::where("kodeRuang", $kodeRuang)->orWhere("namaRuang", $namaRuang)->first();

            if(!$findRuang){
                return response()->json([
                    'message' => 'Data Ruangan tidak ditemukan'
                ],404);
            }

            $findRuang->kodeRuang = $request->kodeRuang;
            $findRuang->namaRuang = $request->namaRuang;

            $findRuang->save();

            return response()->json([
                'message' => 'Data Ruangan Berhasil Di Update'
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],404);
        }
    }

    public function DeleteRuang($kodeRuang){
        $ruang = Ruang::find($kodeRuang);

        if(!$ruang){
            return response()->json([
                'message' => 'Ruang Tidak Ditemukan'
            ],404);
        }
        $ruang->delete();

        return response()->json([
            'message' =>"Ruang Successfully deleted."
        ],200);
    }
}