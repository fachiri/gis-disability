<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBantuanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'jenis' => 'required',
            'detail' => 'required',
            'bukti' => 'nullable|file|mimes:jpeg,png,jpg,zip|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'jenis.required' => 'Mohon isi kolom Jenis.',
            'detail.required' => 'Mohon isi kolom detail.',
        ];
    }
}
