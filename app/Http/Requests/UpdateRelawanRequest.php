<?php

namespace App\Http\Requests;

use App\Models\Relawan;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRelawanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $this->relawan->user->id,
            'gender' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->relawan->user->id),
            ],
            'kontak' => [
                'required',
                function ($attribute, $value, $fail) {
                    $kontakWithoutDash = str_replace('-', '', $value);

                    if ($userKontak = User::where('phone', $kontakWithoutDash)->first()) {
                        if ($userKontak->id != $this->relawan->user->id) {
                            $fail("Kontak sudah digunakan.");
                        }
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
            'nama.required' => 'Mohon isi kolom Nama.',
            'email.required' => 'Mohon isi kolom Email.',
            'email.email' => 'Format Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'kontak.required' => 'Mohon isi kolom Kontak.',
        ];
    }
}
