<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBantuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'penyandang_id' => 'required',
            'jenis' => 'required',
            'detail' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'penyandang_id.required' => 'Mohon isi kolom Penyandang.',
            'jenis.required' => 'Mohon isi kolom Jenis.',
            'detail.required' => 'Mohon isi kolom detail.',
        ];
    }
}
