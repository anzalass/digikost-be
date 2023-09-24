<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemeliharaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'kodeBarang'=> 'required',
            // 'kodeRuang'=> 'required',
            // 'idUser' => 'required',
            // 'jumlah'=> 'required',
            // 'keterangan'=> 'required',
            // 'buktiPembayaran'=> 'required',
            // 'status'=> 'required',
            // 'harga'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'kodeBarang.required'=> 'Kode Barang Tidak Boleh Kosong',
            // 'kodeRuang.required'=> 'Kode Ruang Tidak Boleh Kosong',
            // 'idUser.required' => 'Id User Tidak Boleh Kosong',
            // 'jumlah.required'=> 'Jumlah Tidak Boleh Kosong',
            // 'keterangan.required'=> 'Keterangan Tidak Boleh Kosong',
            // 'buktiPembayaran.required'=> 'Bukti Pembayaran tidak Boleh Kosong',
            // 'status.required'=> 'Status Tidak Boleh Kosong',
            // 'harga.required'=> 'Harga Tidak Boleh Kosong',
        ];
    }
}