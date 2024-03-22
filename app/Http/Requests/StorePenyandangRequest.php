<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenyandangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'relawan_id' => 'required',
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
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'relawan_id.required' => 'Mohon pilih Relawan.',
            'nama.required' => 'Mohon isi kolom Nama.',
            'no_induk_disabilitas.required' => 'Mohon isi kolom Nomor Induk Disabilitas.',
            'nik.required' => 'Mohon isi kolom NIK.',
            'no_kk.required' => 'Mohon isi kolom Nomor KK.',
            'jenis_kelamin.required' => 'Mohon pilih jenis kelamin.',
            'pendidikan_terakhir.required' => 'Mohon pilih pendidikan terakhir.',
            'status_pernikahan.required' => 'Mohon pilih status pernikahan.',
            'kontak.required' => 'Mohon isi kolom Kontak.',
            'district_id.required' => 'Mohon pilih kecamatan.',
            'alamat.required' => 'Mohon isi kolom Alamat.',
            'latitude.required' => 'Mohon pilih lokasi pada peta.',
            'longitude.required' => 'Mohon pilih lokasi pada peta.',
            'foto_diri.required' => 'Mohon unggah foto diri.',
            'foto_diri.image' => 'Foto diri harus dalam format gambar.',
            'foto_diri.mimes' => 'Format gambar yang diterima adalah jpeg, png, jpg, atau gif.',
            'foto_diri.max' => 'Ukuran file foto diri tidak boleh lebih dari 2MB.',
            'foto_ktp.required' => 'Mohon unggah foto KTP.',
            'foto_ktp.image' => 'Foto KTP harus dalam format gambar.',
            'foto_ktp.mimes' => 'Format gambar yang diterima adalah jpeg, png, jpg, atau gif.',
            'foto_ktp.max' => 'Ukuran file foto KTP tidak boleh lebih dari 2MB.',
            'foto_kk.required' => 'Mohon unggah foto KK.',
            'foto_kk.image' => 'Foto KK harus dalam format gambar.',
            'foto_kk.mimes' => 'Format gambar yang diterima adalah jpeg, png, jpg, atau gif.',
            'foto_kk.max' => 'Ukuran file foto KK tidak boleh lebih dari 2MB.',
        ];
    }
}
