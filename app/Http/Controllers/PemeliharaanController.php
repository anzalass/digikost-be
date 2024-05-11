<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemeliharaanRequest;
use Illuminate\Http\Request;

use App\Models\Pemeliharaan;
use App\Models\Aktivitas;
use Exception;
use Illuminate\Support\Facades\Validator;

class PemeliharaanController extends Controller
{
    public function getPemeliharaan(){
        $Pemeliharaan = Pemeliharaan::all();

        return response()->json([
            'results' => $Pemeliharaan,
            'total' => count($Pemeliharaan)
        ],200);
    }

    public function getPemeliharaanById($KodePemeliharaan){
        $findPemeliharaan = Pemeliharaan::where('kodePemeliharaan',$KodePemeliharaan)->first();

        if(!$findPemeliharaan){
            return response()->json([
                "message" => "Data Pemeliharaan Tidak Ditemukan"
            ],404);
        }

        return response()->json([
            "results" => $findPemeliharaan
        ],200);
    }

    public function TambahPemeliharaan(PemeliharaanRequest $request){
        try{
            $validator = Validator::make($request->all(),[
                'kodeBarang'=> 'required',
                'kodeRuang'=> 'required',
                'idUser' => 'required',
                'jumlah'=> 'required',
                'keterangan'=> 'required',
                'buktiPembayaran'=> 'required',
                'status'=> 'required',
                'harga'=> 'required',
            ]);
            if($validator->fails()){
                return response()->json([
                    'error' => $validator->errors()
                ],422);
            }else{
                $pemeliharaan = Pemeliharaan::create([
                    'kodeBarang'=> $request->kodeBarang,
                    'kodeRuang'=> $request->kodeRuang,
                    'idUser' => $request->idUser,
                    'jumlah'=> $request->jumlah,
                    'keterangan'=>$request->keterangan,
                    'buktiPembayaran'=> $request->buktiPembayaran,
                    'status'=> $request->status,
                    'harga'=> $request->harga
                ]);

                Aktivitas::create([
                    'IdPemeliharaan' => $pemeliharaan->kodePemeliharaan, 
                    'IdPembuat' => $request->idUser,
                    'tipe' => "pemeliharaan",
                    'keterangan' => "Request Pemeliharaan Barang"
                ]);
                
                if($pemeliharaan){
                    return response()->json([
                        'message' => 'Pemeliharaan Berhasil Ditambahkan'
                    ],200);
                }else{
                    return response()->json([
                        'message' => 'Pemeliharaan Tidak Berhasil Ditambahkan'
                    ],500); 
                }
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function UpdatePemeliharaan (PemeliharaanRequest $request, $kodePemeliharaan){
       try{
            $findPemeliharaan = Pemeliharaan::where('kodePemeliharaan',$kodePemeliharaan)->first();
            if(!$findPemeliharaan){
                return response()->json([
                    'message' => 'Pemeliharaan tidak ditemukan'
                ],404);
            }

            $validator = Validator::make($request->only(['status']),[
                'status' => 'required',
            ]);
           
            if($validator->fails()){
                  return response()->json([
                    'message'=>$request->status,
                    'error' => $validator->errors()
                ],422);
            }else{
                $findPemeliharaan->status = $request->status;
                $findPemeliharaan->save();

                Aktivitas::create([
                    'IdPemeliharaan' => $kodePemeliharaan, 
                    'IdPembuat' => $findPemeliharaan->idUser,
                    'tipe' => "pemeliharaan",
                    'keterangan' => "Pemeliharaan Status "+$request->status 
                ]);

                return response()->json([
                    'message' => 'Data Pemeliharaan Berhasil Di Update'
                ],200);
            }
       }catch(Exception $e){
            return response()->json([
                'message' => $e
            ],500);
       }
    }

    public function EditPemeliharaan(PemeliharaanRequest $request, $kodePemeliharaan){
        try{
            $findPemeliharaan = Pemeliharaan::where('kodePemeliharaan',$kodePemeliharaan)->first();
            if(!$findPemeliharaan){
                return response()->json([
                    'message' => 'Pemeliharaan tidak ditemukan'
                ],404);
            }

            $validator = Validator::make($request->only(['jumlah', 'harga', 'keterangan']),[
                'jumlah' => 'required',
                'harga' => 'required',
                'keterangan' => 'required',
            ]);
           
            if($validator->fails()){
                  return response()->json([
                    'message'=>$request->status,
                    'error' => $validator->errors()
                ],422);
            }else{
                $findPemeliharaan->jumlah = $request->jumlah;
                $findPemeliharaan->harga = $request->harga;
                $findPemeliharaan->keterangan = $request->keterangan; 
                $findPemeliharaan->save();

                return response()->json([
                    'message' => 'Data Pemeliharaan Berhasil Di Update'
                ],200);
            }
       }catch(Exception $e){
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