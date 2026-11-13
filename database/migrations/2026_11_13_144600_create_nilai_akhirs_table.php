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
        Schema::create('nilai_akhirs', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('id_siswa')->constrained('siswas', 'id_siswa')->onDelete('cascade');
            $table->foreignId('id_mapel')->constrained('mata_pelajarans', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('gurus', 'id_guru')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('cascade');
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('tahun_ajaran');
            $table->integer('nilai_akhir')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_input')->useCurrent();
            $table->unique(['id_siswa', 'id_mapel', 'semester', 'tahun_ajaran'], 'nilai_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_akhirs');
    }
};
