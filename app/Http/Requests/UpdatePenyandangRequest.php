<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenyandangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'no_induk_disabilitas' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'no_kk' => 'required|string|max:16',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pendidikan_terakhir' => 'required|in:Tidak Sekolah,SD,SMP,SMA/SMK,Diploma (D1-D3),Sarjana (S1),Magister (S2),Doktor (S3)',
            'status_pernikahan' => 'required|in:Belum Menikah,Sudah Menikah',
            'keterampilan' => 'nullable|string|max:255',
            'usaha' => 'nullable|string|max:255',
            'kontak' => 'required|string|max:14',
            'district_id' => 'required',
            'alamat' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'jenis_disabilitas' => 'nullable|string|max:255',
            'keterangan_meninggal' => 'nullable|string|max:255',
            'keterangan_sembuh' => 'nullable|string|max:255',
            'foto_diri' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
