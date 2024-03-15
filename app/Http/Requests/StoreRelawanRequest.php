<?php

namespace App\Http\Requests;

use App\Models\Relawan;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreRelawanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'district_id' => 'required',
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'kontak' => [
                'required',
                function ($attribute, $value, $fail) {
                    $kontakWithoutDash = str_replace('-', '', $value);
    
                    if (User::where('phone', $kontakWithoutDash)->exists()) {
                        $fail("Kontak sudah digunakan.");
                    }

                    if (strlen($kontakWithoutDash) < 10 || strlen($kontakWithoutDash) > 12) {
                        $fail("Kontak harus terdiri dari 10 hingga 12 digit.");
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'district_id.required' => 'Mohon isi kolom Kecamatan.',
            'nama.required' => 'Mohon isi kolom Nama.',
            'email.required' => 'Mohon isi kolom Email.',
            'email.email' => 'Format Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'kontak.required' => 'Mohon isi kolom Kontak.',
        ];
    }
}
