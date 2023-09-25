<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
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

    public function UpdateKategori(KategoriRequest $request, $kodeBarang)
    {
        try{
            $kategori = Kategori::where('kodeBarang', $kodeBarang)->first();
            if(!$kategori){
                return response()->json([
                    'message' => "Kategori Not Found"
                ],404);
            }

            $kategori->kodeBarang = $request->kodeBarang;
            $kategori->namaBarang = $request->namaBarang;

            $kategori->save();
            return response()->json([
                'message' => "Kategori Successfully Updated"
            ],200);
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
        ]);
        try{
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()
                ],422);
                // return response()->json(['errors' => $validator->errors()], 422);
            }else{
                Kategori::create([
                    'kodeBarang'=> $request->kodeBarang,
                    'namaBarang'=> $request->namaBarang
                ]);

                return response()->json([
                    'message'=> "Kategori Successfully Created"
                ],200);
            }    
        }catch(\Exception $e){
            return response()->json([
                'message'=> "gg"
            ],500);
        }
    }

    public function DeleteKategori($kodeBarang)
    {
        $kategori = Kategori::where('kodeBarang',$kodeBarang)->delete();
        if($kategori){
            return response()->json([
                'message' =>"Kategori successfully deleted."
            ],200);
        }

    }
}