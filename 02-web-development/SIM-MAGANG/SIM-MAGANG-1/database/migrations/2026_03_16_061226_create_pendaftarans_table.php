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
        Schema::create('pendaftarans', function (Blueprint $table) {

    $table->id();

    $table->string('nama');
    $table->string('email');
    $table->string('whatsapp');

    $table->string('universitas');
    $table->string('prodi');

    $table->enum('jenis_magang',['Reguler','MBKM']);

    $table->string('cv');
    $table->string('portfolio')->nullable();

            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();

            $table->string('divisi1')->nullable();
            $table->string('divisi2')->nullable();

            $table->enum('status',['menunggu','diterima','ditolak'])
                ->default('menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
