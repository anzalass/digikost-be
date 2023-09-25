<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuangRequest;
use App\Models\Pengadaan;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuangController extends Controller
{
    public function index(){
        $ruang = Ruang::all();

        if($ruang){
            return response()->json([
                'results' => $ruang,
                'total' => count($ruang)
            ],200);
        }

        return response()->json([
            'message' => 'Data Ruangan tidak ditemukan'
        ],404);
    }

    public function TambahRuang(RuangRequest $request){
        try{
            $validator = Validator::make($request->all(),[
                'kodeRuang' => 'required|string|max:255',
                'ruang' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                return response()->json([
                    'error'=>$validator->errors()
                ],422);
            }else{
                Ruang::create([
                    'kodeRuang' => $request->kodeRuang,
                    'ruang' => $request->ruang
                ]);
                return response()->json([
                    'message' => $request->ruang
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],500);
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

    public function UpdateRuang(RuangRequest $request){
        try{
            $validator = Validator::make($request->all(),[
                'kodeRuang' => 'required|string|max:255',
                'ruang' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                return response()->json([
                    'error'=>$validator->errors()
                ],422);
            }else{
                $findRuang = Ruang::where("kodeRuang", $request->kodeRuang)->first();

                if(!$findRuang){
                    return response()->json([
                        'message' => 'Data Ruangan tidak ditemukan'
                    ],404);
                }

                $findRuang->ruang = $request->ruang;

                $findRuang->save();

                return response()->json([
                    'message' => 'Data Ruangan Berhasil Di Update'
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'test'
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