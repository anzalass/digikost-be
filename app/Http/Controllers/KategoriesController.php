<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use App\Models\Aktivitas;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KategoriesController extends Controller
{
    public function index()
    {
        $result = Kategori::all();
        return response()->json([
            'results' => $result,
            'total'=> count($result)
        ],200);
    }

    public function FindKategori($kodeBarang, $namaBarang)
    {
        $result = Kategori::where('kodeBarang',$kodeBarang)->orWhere('namaBarang', $namaBarang)->first();

        if($result){
            return response()->json([
                'results' => $result
            ],200);
        }else{
            return response()->json([
                'message' =>"Kategori not found."
            ],404);
        }
    }

    public function UpdateKategori(Request $request, $kodeBarang)
    {
        $validator = Validator::make($request->all(), [
            'namaBarang' => 'required|string|max:255',
            'merekBarang'=>'required|string|max:255'
        ]);
        try{
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()
                ],422);
                // return response()->json(['errors' => $validator->errors()], 422);
            }else{
                $kategori = Kategori::where('kodeBarang', $kodeBarang)->first();
                if(!$kategori){
                    return response()->json([
                        'message' => "Kategori Not Found"
                    ],404);
                }
    
                $kategori->kodeBarang = $kodeBarang;
                $kategori->namaBarang = $request->namaBarang;
                $kategori->kategori = $request->merekBarang;
    
                $kategori->save();
    
                $getalluser = User::all();


                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => 0,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'mengupdate kategori',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/tambah-barang',
                        'keterangan' => $request->nama_pembuat . " Mengupdate Kategori Dengan Kode " . $kodeBarang . " Menjadi " . $kategori->namaBarang,
    
                    ]);
                }
    
                Aktivitas::create([
                    'id_kegiatan'=> 0,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'hapus kategori',
                    'url' => 'http://localhost:5173/tambah-barang',
                    'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate  Kategori Dengan Kode". " ". $kodeBarang . " Menjadi " . $kategori->namaBarang, 
                ]);
    
                return response()->json([
                    'message' => "Kategori Successfully Updated"
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],200);
        }
    }

    public function TambahKategori(KategoriRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'kodeBarang' => 'required|string|max:20',
            'namaBarang' => 'required|string|max:255',
            'merekBarang'=>'required|string|max:255'
      
        ]);
        try{
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()
                ],422);
                // return response()->json(['errors' => $validator->errors()], 422);
            }else{
                $kategori = Kategori::create([
                    'kodeBarang'=> $request->kodeBarang,
                    'namaBarang'=> $request->namaBarang,
                    'kategori' =>$request->merekBarang
                ]);

                $getalluser = User::all();

                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => 0,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'tambah kategori',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/tambah-barang',
                        'keterangan'=> $request->nama_pembuat ." ". "Membuat  Kategori Baru" . " " . $request->namaBarang, 

                    ]);
                }

                Aktivitas::create([
                    'id_kegiatan'=> 0,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'tambah kategori',
                    'url' => 'http://localhost:5173/tambah-barang',
                    'keterangan'=> $request->nama_pembuat  . " ". "Membuat  Kategori Baru". " " .$request->namaBarang, 
                ]);


          
                return response()->json([
                    'message'=> "Kategori Successfully Created",
                ],200);
            }    
        }catch(\Exception $e){
            return response()->json([
                'message'=> "error",
                'error' => $e,
            ],500);
        }
    }

    public function DeleteKategori(Request $request,$kodeBarang)
    {
        try {
            //code...
            $kategori = Kategori::where('kodeBarang',$kodeBarang)->delete();

            $getalluser = User::all();
            foreach($getalluser as $user) {
                Notifikasi::create([
                    'untuk' => $user->id,
                    'id_kegiatan' => 0,
                    'id_pembuat' => $request->id_pembuat,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'hapus kategori',
                    'status' => 'belumdibaca',
                    'url' => 'http://localhost:5173/tambah-barang',
                    'keterangan'=> $request->nama_pembuat  . " ". "Menghapus  Kategori". " " . $request->namaBarang . " ". "Dengan Kode"  . " " .$kodeBarang, 

                ]);
            }

            Aktivitas::create([
                'id_kegiatan'=> 0,
                'nama_pembuat' => $request->nama_pembuat,
                'role_pembuat' => $request->role_pembuat,
                'tipe' => 'hapus kategori',
                'url' => 'http://localhost:5173/tambah-barang',
                'keterangan'=> $request->nama_pembuat  . " ". "Menghapus  Kategori". " " . $request->namaBarang . " ". "Dengan Kode"  ." " . $kodeBarang, 
            ]);

            if($kategori){
                return response()->json([
                    'message' =>"Kategori successfully deleted."
                ],200);
            }
        } catch(\Exception $e){
            return response()->json([
                'message'=> $e,
                'error' => $e->getMessage(),
            ],500);
        }
      

    }
}