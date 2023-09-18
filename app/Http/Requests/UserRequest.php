<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'noHP' => 'required|string|max:13'
        ];
    }

    public function messages(){
        return[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email salah',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password harus berupa text',
            'password.max' => 'max length password adalah 255',
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama harus berupa text',
            'name.max' => 'max length name adalah 255',
            'role.required' => 'Role tidak boleh kosong',
            'role.string' => 'Role harus berupa text',
            'role.max' => 'max length Role adalah 1',
            'noHP.required' => 'Nomor HP tidak boleh kosong',
            'noHP.string' => 'Nomor HP harus berupa text',
            'noHP.max' => 'max length nomor HP adalah 13',
        ];
    }
}