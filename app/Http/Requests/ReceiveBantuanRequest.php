<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveBantuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bukti' => 'required|file|mimes:jpeg,png,jpg,zip|max:2048'
        ];
    }
}
