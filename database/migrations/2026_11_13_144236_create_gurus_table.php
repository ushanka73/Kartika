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
    Schema::create('gurus', function (Blueprint $table) {
        $table->id('id_guru');
        $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
        $table->string('nip')->unique();
        $table->string('nama_lengkap');
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->text('alamat');
        $table->string('no_telepon');
        $table->string('email')->unique();
        $table->string('pendidikan_terakhir');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
