<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            if (!Schema::hasColumn('batches', 'tanggal_admin_mulai')) {
                $table->date('tanggal_admin_mulai')->nullable();
            }
            if (!Schema::hasColumn('batches', 'tanggal_admin_selesai')) {
                $table->date('tanggal_admin_selesai')->nullable();
            }
            if (!Schema::hasColumn('batches', 'tanggal_wawancara_mulai')) {
                $table->date('tanggal_wawancara_mulai')->nullable();
            }
            if (!Schema::hasColumn('batches', 'tanggal_wawancara_selesai')) {
                $table->date('tanggal_wawancara_selesai')->nullable();
            }
            if (!Schema::hasColumn('batches', 'tanggal_pengumuman')) {
                $table->date('tanggal_pengumuman')->nullable();
            }
            if (!Schema::hasColumn('batches', 'kuota')) {
                $table->unsignedInteger('kuota')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $columns = [
                'tanggal_admin_mulai',
                'tanggal_admin_selesai',
                'tanggal_wawancara_mulai',
                'tanggal_wawancara_selesai',
                'tanggal_pengumuman',
                'kuota',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('batches', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
