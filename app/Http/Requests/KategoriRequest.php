<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            'kodeBarang' => 'required|string|max:20',
            'namaBarang' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return[
            'kodeBarang.required' => 'Kode Barang required',
            'namaBarang.required' => 'Nama Barang required',
        ];
    }
}