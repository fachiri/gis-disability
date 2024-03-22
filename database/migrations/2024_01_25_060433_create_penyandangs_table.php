<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyandangs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('no_induk_disabilitas', 16);
            $table->string('nama', 50);
            $table->string('jenis_kelamin', 9);
            $table->string('kontak', 12);
            $table->string('foto_diri');
            $table->string('foto_ktp');
            $table->string('nik', 16);
            $table->string('foto_kk');
            $table->string('no_kk', 16);
            $table->string('alamat');
            $table->string('jenis_disabilitas', 50)->nullable();
            $table->string('pendidikan_terakhir', 50);
            $table->string('keterampilan', 50)->nullable();
            $table->string('usaha', 50)->nullable();
            $table->string('status_pernikahan', 50);
            $table->string('latitude');
            $table->string('longitude');
            $table->string('keterangan_meninggal', 50)->nullable();
            $table->string('keterangan_sembuh', 50)->nullable();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->foreignId('relawan_id')->constrained('relawans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyandangs');
    }
};
