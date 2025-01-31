<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuangRequest;
use App\Models\Pengadaan;
use App\Models\Ruang;
use App\Models\Aktivitas;
use App\Models\Notifikasi;
use App\Models\User;
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
                $ruang = Ruang::create([
                    'kodeRuang' => $request->kodeRuang,
                    'ruang' => $request->ruang
                ]);

                $getalluser = User::all();
                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => 1,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'menambah ruang',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/detail-ruangan/'. $ruang->kodeRuang,
                        'keterangan'=> $request->nama_pembuat  . " ". "Menambah Ruangan Baru". " ". $ruang->kodeRuang, 
    
                    ]);
                }
    
                Aktivitas::create([
                    'id_kegiatan'=> 1,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'menambah ruang',
                    'url' => 'http://localhost:5173/detail-ruangan/'. $ruang->kodeRuang,
                    'keterangan'=> $request->nama_pembuat  . " ". "Menambah Ruangan Baru". " ". $ruang->kodeRuang, 
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

                $getalluser = User::all();
                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => 1,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'mengupdate ruang',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/detail-ruangan/'. $findRuang->kodeRuang,
                        'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate Ruangan ". " ". $findRuang->kodeRuang, 
    
                    ]);
                }
    
                Aktivitas::create([
                    'id_kegiatan'=> 1,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'mengupdate ruang',
                    'url' => 'http://localhost:5173/detail-ruangan/'. $findRuang->kodeRuang,
                    'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate Ruangan ". " ". $findRuang->kodeRuang, 
                ]);
                return response()->json([
                    'message' => 'Data Ruangan Berhasil Di Update'
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'test',
                'error' => $e->getMessage(),
            ],404);
        }
    }

    public function DeleteRuang(Request $request,$kodeRuang){
        $ruang = Ruang::find($kodeRuang);

        $getalluser = User::all();
        foreach($getalluser as $user) {
            Notifikasi::create([
                'untuk' => $user->id,
                'id_kegiatan' => 1,
                'id_pembuat' => $request->id_pembuat,
                'nama_pembuat' => $request->nama_pembuat,
                'role_pembuat' => $request->role_pembuat,
                'tipe' => 'Menghapus ruang',
                'status' => 'belumdibaca',
                'url' => 'http://localhost:5173/data-ruangan/',
                'keterangan'=> $request->nama_pembuat  . " ". "Menghapus Ruangan ". " ". $ruang->kodeRuang, 

            ]);
        }

        Aktivitas::create([
            'id_kegiatan'=> 1,
            'nama_pembuat' => $request->nama_pembuat,
            'role_pembuat' => $request->role_pembuat,
            'tipe' => 'Menghapus ruang',
            'url' => 'http://localhost:5173/data-ruangan/',
            'keterangan'=> $request->nama_pembuat  . " ". "Menghapus Ruangan ". " ". $ruang->kodeRuang, 
        ]);

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