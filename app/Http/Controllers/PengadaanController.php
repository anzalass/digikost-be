<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemeliharaanRequest;
use App\Http\Requests\PengadaanRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Kategori;
use App\Models\Pengadaan;
use App\Models\Aktivitas;
use App\Models\Notifikasi;
use App\Models\User;
use App\Models\Ruang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PengadaanController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
        $pengadaan = Pengadaan::all();

        return response()->json([

            'result' => $pengadaan,

            'total' => count($pengadaan)
        ],200);
    }

    public function PengadaanBarangPage() {
        $pengadaan = Pengadaan::all();
        $kategori = Kategori::all();
        $ruang = Ruang::all();
        return response()->json([
            'pengadaan' => $pengadaan,
            'kategori' => $kategori,
            'ruang' => $ruang,
           
        ],200);

    }

    public function TambahPengadaan(PengadaanRequest $request){
        $validator = Validator::make($request->all(),[
            'namaBarang' => 'required|string|max:255',
            'kodeBarang' => 'required|string|max:255',
            'kodeRuang' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'hargaBarang' => 'required',
            'quantity' => 'required',
            'spesifikasi' => 'string|max:255',
            'ruang' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
        ]);

        if($validator->fails()){

            return response()->json([
                'error' => $validator->errors(),
                'message' => $validator
            ],422);
        }else{
            try{
                $pengadaan = Pengadaan::create([
                    'idUser' => $request->idUser,
                    'namaBarang' => $request->namaBarang,
                    'kodeBarang' => $request->kodeBarang,
                    'kodeRuang' => $request->kodeRuang,
                    'merek' => $request->merek,
                    'hargaBarang'=> $request->hargaBarang,
                    'quantity' => $request->quantity,
                    'spesifikasi' => $request->spesifikasi,
                    'keterangan' => $request->keterangan,
                    'ruang' => $request->ruang,
                    'supplier' => $request->supplier,
                    'linkBarcode' => env('FRONTEND_URL') . '/api/' . $request->ruang,
                ]);

                $getalluser = User::all();
                foreach($getalluser as $user) {
                    Notifikasi::create([
                        'untuk' => $user->id,
                        'id_kegiatan' => $pengadaan->id,
                        'id_pembuat' => $request->id_pembuat,
                        'nama_pembuat' => $request->nama_pembuat,
                        'role_pembuat' => $request->role_pembuat,
                        'tipe' => 'menambah pengadaan',
                        'status' => 'belumdibaca',
                        'url' => 'http://localhost:5173/detail-pengadaan/'. $pengadaan->id,
                        'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
    
                    ]);
                }
    
                Aktivitas::create([
                    'id_kegiatan'=> $pengadaan->id,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'menambah pengadaan',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. $pengadaan->id,
                    'keterangan'=> $request->nama_pembuat  . " ". "Menambah Pengadaan Baru". " ". $request->namBarang, 
                ]);
    

                return response()->json([
                    'message' => "Pengadaan Successfully Created"
                ],200);
            }catch(\Exception $e){
                return response()->json([
                    'message' => $e
                ],500);
            }
        }
    }

    public function AksiOwnerPengadaan(PengadaanRequest $request, $kodeBarang){
        try{
            $findPengadaan = Pengadaan::where('id', $kodeBarang)->first();

            if(!$findPengadaan){
                return response()->json([
                    'message'=> 'Gabisa'
                ],404);
            } 

            $findPengadaan->status = $request->status;
            $findPengadaan->save();


            $getalluser = User::all();
            foreach($getalluser as $user) {
                Notifikasi::create([
                    'untuk' => $user->id,
                    'id_kegiatan' => $findPengadaan->id,
                    'id_pembuat' => $request->id_pembuat,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'mengupdate status pengadaan',
                    'status' => 'belumdibaca',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. $kodeBarang,
                    'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate  Status Pengadaan". " ". $findPengadaan->namaBarang . "Menjadi". " ". $request->status, 

                ]);
            }

            Aktivitas::create([
                'id_kegiatan'=> $findPengadaan->id,
                'nama_pembuat' => $request->nama_pembuat,
                'role_pembuat' => $request->role_pembuat,
                'tipe' => 'mengupdate status pengadaan',
                'url' => 'http://localhost:5173/detail-pengadaan/'. $kodeBarang,
                'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate  Status Pengadaan". " ". $findPengadaan->namaBarang . "Menjadi". " ". $request->status, 

            ]);

            return response()->json([
                'message'=> 'bisa',
                'res'=> $findPengadaan
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $request->status
            ],500);
        }
    }

    public function FindByKategori($kodeBarang,$ruang){
        try{
            $pengadaan = Pengadaan::where('kodeBarang',$kodeBarang)->first();
            if($pengadaan){
                return response()->json([
                    'results' => $pengadaan
                ],200);
            }
            return response()->json([
                'message' => "Barang tidak ditemukan"
            ],404);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function getBarangRuangan($kodeRuang){
        try{
            $pengadaan = Pengadaan::where("ruang",$kodeRuang)->first();
            if($pengadaan){
                return response()->json([
              
                    'results' => $pengadaan,

                ],200);
            }

            return response()->json([
                'message' => 'Tidak Ada Barang'
            ],404);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function UpdatePengadaan(PengadaanRequest $request, $id){
        try{
            $pengadaan = Pengadaan::find($id);


            $getalluser = User::all();
            foreach($getalluser as $user) {
                Notifikasi::create([
                    'untuk' => $user->id,
                    'id_kegiatan' => $pengadaan->id,
                    'id_pembuat' => $request->id_pembuat,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'mengupdate pengadaan',
                    'status' => 'belumdibaca',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. $id,
                    'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate  Pengadaan Barang". " ". $pengadaan->namaBarang, 

                ]);
            }

            Aktivitas::create([
                'id_kegiatan'=> $pengadaan->id,
                'nama_pembuat' => $request->nama_pembuat,
                'role_pembuat' => $request->role_pembuat,
                'tipe' => 'mengupdate pengadaaan',
                'url' => 'http://localhost:5173/detail-pengadaan/'. $id,
                'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate  Pengadaan Barang". " ". $pengadaan->namaBarang, 

            ]);


            if(!$pengadaan){
                return response()->json([
                    'message' =>"Pengadaan not found."
                ],404);
            }

            $pengadaan->namaBarang = $request->namaBarang;
            $pengadaan->kodeBarang = $request->kodeBarang;
            $pengadaan->kodeRuang = $request->kodeRuang;
            $pengadaan->merek = $request->merek;
            $pengadaan->quantity = $request->quantity;
            $pengadaan->hargaBarang = $request->hargaBarang;
            $pengadaan->spesifikasi = $request->spesifikasi;
            $pengadaan->ruang = $request->ruang;
            // $pengadaan->keterangan = $request->keterangan;
            $pengadaan->supplier = $request->supplier;
            $pengadaan->buktiNota = $request->buktiNota;

            $pengadaan->save();

            return response()->json([
                'message' => "Pengadaan Successfully Updated"
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    
    public function UpdateResi(PengadaanRequest $request, $id){
        try{
            $validator = Validator::make($request->all(),[
                'NoResi' => 'required|string|max:50',
                'buktiNota' => 'required|string|max:255',
            ]);
            if($validator->fails()){

                return response()->json([
                    'error' => $validator->errors(),
                    'message' => $validator
                ],422);
            }
            
            $pengadaan = Pengadaan::find($id);
            if(!$pengadaan){
                return response()->json([
                    'message' =>"Pengadaan not found."
                ],404);
            }

            $pengadaan->NoResi = $request->NoResi;
            $pengadaan->buktiNota = $request->buktiNota;

            $pengadaan->save();

            $getalluser = User::all();
            foreach($getalluser as $user) {
                Notifikasi::create([
                    'untuk' => $user->id,
                    'id_kegiatan' => $pengadaan->id,
                    'id_pembuat' => $request->id_pembuat,
                    'nama_pembuat' => $request->nama_pembuat,
                    'role_pembuat' => $request->role_pembuat,
                    'tipe' => 'menambah resi',
                    'status' => 'belumdibaca',
                    'url' => 'http://localhost:5173/detail-pengadaan/'. $id,
                    'keterangan'=> $request->nama_pembuat  . " ". "Menambahkan Resi". " ". $pengadaan->namaBarang, 

                ]);
            }

            Aktivitas::create([
                'id_kegiatan'=>  $pengadaan->id,
                'nama_pembuat' => $request->nama_pembuat,
                'role_pembuat' => $request->role_pembuat,
                'tipe' => 'menambah resi',
                'url' => 'http://localhost:3000/tambah-barang',
                'url' => 'http://localhost:5173/detail-pengadaan/'. $id,
                'keterangan'=> $request->nama_pembuat  . " ". "Menambahkan Resi". " ". $pengadaan->namaBarang, 

            ]);


            return response()->json([
                'message' => "Pengadaan Successfully Updated"
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ],500);
        }
    }

    public function FindPengadaan($id){
        $pengadaan = Pengadaan::find($id);

        if($pengadaan){
            return response()->json([
                'results' => $pengadaan
            ],200);
        }else{
            return response()->json([
                'message' =>"Pengadaan not found."
            ],404);
        }
    }

    public function UpdateStatusPengadaan (PengadaanRequest $request, $id){
        try{
             $findPengadaan = Pengadaan::find($id);
             if(!$findPengadaan){
                 return response()->json([
                     'message' => 'Pengadaan tidak ditemukan'
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
                 $findPengadaan->status = $request->status;
                 if($request->status == "selesai"){
                    $findPengadaan->is_active = 1;
                 }else if($request->status == "ditolak"){
                    $findPengadaan->is_active = 0;
                 }
                 $findPengadaan->save();


                 $getalluser = User::all();
                 foreach($getalluser as $user) {
                     Notifikasi::create([
                         'untuk' => $user->id,
                         'id_kegiatan' => $findPengadaan->id,
                         'id_pembuat' => $request->id_pembuat,
                         'nama_pembuat' => $request->nama_pembuat,
                         'role_pembuat' => $request->role_pembuat,
                         'tipe' => 'mengupdate status',
                         'status' => 'belumdibaca',
                         'url' => 'http://localhost:5173/detail-pengadaan/'. $id,
                         'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate Status Pengadaan". " ". $findPengadaan->namaBarang  , 
     
                     ]);
                 }
     
                 Aktivitas::create([
                     'id_kegiatan'=> $findPengadaan->id,
                     'nama_pembuat' => $request->nama_pembuat,
                     'role_pembuat' => $request->role_pembuat,
                     'tipe' => 'mengupdate status',
                     'url' => 'http://localhost:5173/detail-pengadaan/'. $id,
                      'keterangan'=> $request->nama_pembuat  . " ". "Mengupdate Status Pengadaan". " ". $findPengadaan->namaBarang  , 
     
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





    public function DeletePengadaan(Request $request, $id){
        $pengadaan = Pengadaan::find($id);


        $getalluser = User::all();
        foreach($getalluser as $user) {
            Notifikasi::create([
                'untuk' => $user->id,
                'id_kegiatan' => 0,
                'id_pembuat' => $request->id_pembuat,
                'nama_pembuat' => $request->nama_pembuat,
                'role_pembuat' => $request->role_pembuat,
                'tipe' => 'Menghapus Pengadaan',
                'status' => 'belumdibaca',
                'url' => 'http://localhost:5173/tambah-barang',
                'keterangan'=> $request->nama_pembuat  . " ". "Menghapus Pengadaan". " ". $pengadaan->namaBarang  , 

            ]);
        }

        Aktivitas::create([
            'id_kegiatan'=> 0,
            'nama_pembuat' => $request->nama_pembuat,
            'role_pembuat' => $request->role_pembuat,
            'tipe' => 'Menghapus Pengadaan',
            'url' => 'http://localhost:5173/tambah-barang',
             'keterangan'=> $request->nama_pembuat  . " ". "Menghapus Pengadaan ". " ". $pengadaan->namaBarang  , 

        ]);
        

        if(!$pengadaan){
            return response()->json([
            'message' =>"Pengadaan not found."
            ],404);
        }

        $pengadaan->delete();

        return response()->json([
            'message' =>"Pengadaan successfully deleted."
        ],200);
    }
}