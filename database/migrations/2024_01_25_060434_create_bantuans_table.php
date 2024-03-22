<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bantuans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('status', 9)->default('DIAJUKAN');
            $table->string('jenis');
            $table->string('detail');
            $table->string('bukti')->nullable();
            $table->foreignId('penyandang_id')->constrained('penyandangs')->onDelete('cascade');
            $table->foreignId('relawan_id')->constrained('relawans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bantuans');
    }
};
