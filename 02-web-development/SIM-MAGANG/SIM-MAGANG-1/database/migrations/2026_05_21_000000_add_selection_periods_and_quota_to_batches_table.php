<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->date('tanggal_admin_mulai')->nullable()->after('tanggal_selesai');
            $table->date('tanggal_admin_selesai')->nullable()->after('tanggal_admin_mulai');
            $table->date('tanggal_wawancara_mulai')->nullable()->after('tanggal_admin_selesai');
            $table->date('tanggal_wawancara_selesai')->nullable()->after('tanggal_wawancara_mulai');
            $table->date('tanggal_pengumuman')->nullable()->after('tanggal_wawancara_selesai');
            $table->unsignedInteger('kuota')->nullable()->after('tanggal_pengumuman');
        });
    }

    public function down(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_admin_mulai',
                'tanggal_admin_selesai',
                'tanggal_wawancara_mulai',
                'tanggal_wawancara_selesai',
                'tanggal_pengumuman',
                'kuota',
            ]);
        });
    }
};
