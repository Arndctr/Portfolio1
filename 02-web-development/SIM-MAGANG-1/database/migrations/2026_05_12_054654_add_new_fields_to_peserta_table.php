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
        Schema::table('peserta', function (Blueprint $table) {
            $table->string('sosial_media')->nullable()->after('prodi');
            $table->string('usaha_bisnis')->nullable()->after('sosial_media');
            $table->string('durasi_magang')->nullable()->after('jenis_magang');
            $table->string('khs')->nullable()->after('cv');
            $table->string('bukti_follow')->nullable()->after('khs');
            
            // Change jenis_magang to string to support more options
            $table->string('jenis_magang')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropColumn(['sosial_media', 'usaha_bisnis', 'durasi_magang', 'khs', 'bukti_follow']);
        });
    }
};
