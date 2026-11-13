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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->foreignId('wali_kelas')->constrained('gurus', 'id_guru');
            $table->enum('tingkat', ['X', 'XI', 'XII']);
            $table->enum('jurusan', ['IPA', 'IPS', 'Bahasa']);
            $table->string('tahun_ajaran');
            $table->unique(['tingkat', 'jurusan', 'tahun_ajaran'], 'kelas_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
