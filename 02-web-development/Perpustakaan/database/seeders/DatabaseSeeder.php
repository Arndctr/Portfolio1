<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Anggota;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'guru']);
        Role::firstOrCreate(['name' => 'siswa']);

        /* =======================
         |  ADMIN
         |=======================*/
        $admin = User::factory()->create([
            'name'                => 'Admin Perpustakaan',
            'nis_nip'             => 'ADM001',                         // ← untuk login
            'email'               => 'admin_perpustakaan@smp12yk.sch.id',
            'password'            => Hash::make('akuAdminKeren_13579'), // bukan default
            'is_default_password' => false,                             // tidak dipaksa ubah
        ]);
        $admin->assignRole('admin');

        /* =======================
         |  GURU
         |=======================*/
        $guru = User::factory()->create([
            'name'                => 'Guru Contoh',
            'nis_nip'             => '198506012023051002',              // contoh NIP
            'email'               => 'guru@example.com',
            'password'            => Hash::make('12345678'),            // password default
            'is_default_password' => true,
        ]);
        $guru->assignRole('guru');

        /* =======================
         |  SISWA
         |=======================*/
        $siswa = User::factory()->create([
            'name'                => 'Siswa Contoh',
            'nis_nip'             => '2023123456',                      // contoh NIS
            'email'               => 'siswa@example.com',
            'password'            => Hash::make('12345678'),           // password default
            'is_default_password' => true,
        ]);

        $siswa->assignRole('siswa');
    }
}
