<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengadaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        if(request()->isMethod('post')){
            return [
                'namaBarang' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'hargaBarang' => 'required|numeric', // Numeric validation
                'quantity' => 'required|integer',   // Integer validation
                'spesifikasi' => 'string|max:255',   // Optional validation
                'ruang' => 'required|string|max:255',
                'supplier' => 'required|string|max:255',
                'buktiNota' => 'string|max:255',   // Optional validation
            ];
        }else{
            return [
                'namaBarang' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'hargaBarang' => 'required|numeric', // Numeric validation
                'quantity' => 'required|integer',   // Integer validation
                'spesifikasi' => 'string|max:255',   // Optional validation
                'ruang' => 'required|string|max:255',
                'supplier' => 'required|string|max:255',
                'buktiNota' => 'string|max:255',   // Optional validation
            ];
        }
    }

        public function messages()
    {
        if(request()->isMethod('post')){
            return [
                'namaBarang.required' => 'Nama Barang required',
                'merek' => 'Merek required',
                'hargaBarang' => 'Harga Barang required', // Numeric validation
                'quantity' => 'Quantity required',   // Integer validation
                'spesifikasi' => 'Spesifikasi required',   // Optional validation
                'ruang' => 'Ruang required',
                'supplier' => 'Supplier required',
                'buktiNota' => 'Bukti Nota required',   // Optional validation
            ];
        }else{
            return [
                'namaBarang.required' => 'Nama Barang required',
                'merek' => 'Merek required',
                'hargaBarang' => 'Harga Barang required', // Numeric validation
                'quantity' => 'Quantity required',   // Integer validation
                'spesifikasi' => 'Spesifikasi required',   // Optional validation
                'ruang' => 'Ruang required',
                'supplier' => 'Supplier required',
                'buktiNota' => 'Bukti Nota required',   // Optional validation
            ];
        }
    }
}