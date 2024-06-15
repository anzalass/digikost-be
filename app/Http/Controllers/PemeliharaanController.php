<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemeliharaanRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemeliharaan;
use App\Models\Aktivitas;
use App\Models\Notifikasi;
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

                $getalluser = User::all();
                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => 2,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'menambah pengadaan',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                        'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
    
                    ]);
                }
    
                Aktivitas::create([
                    'id_kegiatan'=> 2,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'menambah pengadaan',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                    'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
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

                $getalluser = User::all();
                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => 2,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'menambah pengadaan',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                        'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
    
                    ]);
                }
    
                Aktivitas::create([
                    'id_kegiatan'=> 2,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'menambah pengadaan',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                    'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
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


                $getalluser = User::all();
                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => 2,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'menambah pengadaan',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                        'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
    
                    ]);
                }
    
                Aktivitas::create([
                    'id_kegiatan'=> 2,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'menambah pengadaan',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                    'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
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

    public function hapusPemeliharaan(PemeliharaanRequest $request, $kodePemeliharaan){
        $findPemeliharaan = Pemeliharaan::where('kodePemeliharaan',$kodePemeliharaan)->first();

        if($findPemeliharaan){

            $getalluser = User::all();

            foreach($getalluser as $user) {
                Notifikasi::create([
                    'untuk' => $user->id,
                    'id_kegiatan' => 2,
                    'id_pembuat' => $request->id_pembuat,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'menambah pengadaan',
                    'status' => 'belumdibaca',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                    'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 

                ]);
            }
            Aktivitas::create([
                'id_kegiatan'=> 2,
                'nama_pembuat' => $request->nama_pembuat,
                'role_pembuat' => $request->role_pembuat,
                'tipe' => 'menambah pengadaan',
                'url' => 'http://localhost:5173/detail-pengadaan/'. 2,
                'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
            ]);
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