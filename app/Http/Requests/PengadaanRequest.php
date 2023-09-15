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
                'kodeBarang' => 'required|string|max:255',
                'kodeRuang' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'hargaBarang' => 'required|numeric', // Numeric validation
                'quantity' => 'required|integer',   // Integer validation
                'spesifikasi' => 'string|max:255',   // Optional validation
                'ruang' => 'required|string|max:255',
                'supplier' => 'required|string|max:255',
                'buktiNota' => 'nullable|file|max:2048',   // Optional validation
            ];
        }else{
            return [
                'namaBarang' => 'required|string|max:255',
                'kodeBarang' => 'required|string|max:255',
                'kodeRuang' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'hargaBarang' => 'required|numeric', // Numeric validation
                'quantity' => 'required|integer',   // Integer validation
                'spesifikasi' => 'string|max:255',   // Optional validation
                'ruang' => 'required|string|max:255',
                'supplier' => 'required|string|max:255',
                'buktiNota' => 'nullable|file|max:2048',   // Optional validation
            ];
        }
    }

        public function messages()
    {
        if(request()->isMethod('post')){
            return [
                'namaBarang.required' => 'Nama Barang required',
                'kodeBarang.required' => 'Kode Barang required',
                'kodeRuang.required' => 'Kode Ruang required',
                'merek' => 'Merek required',
                'hargaBarang.required' => 'Harga Barang is required.',
                'hargaBarang.numeric' => 'Harga Barang must be numeric.',
                'quantity.required' => 'Quantity is required.',
                'quantity.integer' => 'Quantity must be an integer.',
                'spesifikasi' => 'Spesifikasi required',   // Optional validation
                'ruang' => 'Ruang required',
                'supplier' => 'Supplier required',
                'buktiNota.file' => 'Bukti Nota must be a file.',
                'buktiNota.max' => 'Bukti Nota cannot be larger than 2MB.',   // Optional validation
            ];
        }else{
            return [
                'namaBarang.required' => 'Nama Barang required',
                'kodeBarang.required' => 'Kode Barang required',
                'kodeRuang.required' => 'Kode Ruang required',
                'merek' => 'Merek required',
                'hargaBarang.required' => 'Harga Barang is required.',
                'hargaBarang.numeric' => 'Harga Barang must be numeric.',
                'quantity.required' => 'Quantity is required.',
                'quantity.integer' => 'Quantity must be an integer.',
                'spesifikasi' => 'Spesifikasi required',   // Optional validation
                'ruang' => 'Ruang required',
                'supplier' => 'Supplier required',
                'buktiNota.file' => 'Bukti Nota must be a file.',
                'buktiNota.max' => 'Bukti Nota cannot be larger than 2MB.',   // Optional validation
            ];
        }
    }
}