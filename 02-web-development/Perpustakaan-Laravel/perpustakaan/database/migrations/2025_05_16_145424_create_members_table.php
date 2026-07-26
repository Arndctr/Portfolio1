<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('role', ['siswa', 'guru'])->default('siswa');
            $table->string('nis_nip', 20)->unique();
            $table->string('kelas', 10)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat', 255)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('email', 255)->nullable(); 
            $table->string('plain_password')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
