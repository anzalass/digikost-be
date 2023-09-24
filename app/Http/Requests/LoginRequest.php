<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        ];
    }

    public function messages(){
        return[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email salah',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password harus berupa text',
            'password.max' => 'max length password adalah 255',
        ];
    }
}