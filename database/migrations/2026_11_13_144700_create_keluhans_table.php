<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id('id_keluhan');
            $table->foreignId('id_siswa')->constrained('siswas', 'id_siswa')->onDelete('cascade');
            $table->string('judul');
            $table->text('isi');
            $table->enum('kategori', ['Akademik', 'Fasilitas', 'Pelayanan', 'Lainnya']);
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhans');
    }
};
