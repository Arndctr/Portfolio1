<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi = [
            'SME Relation',
            'Social Media Specialist',
            'Event Specialist',
            'Graphic Design'
        ];

        // Delete existing divisions first to ensure sync
        Divisi::query()->delete();

        foreach ($divisi as $nama) {
            Divisi::create(['nama' => $nama]);
        }
    }
}
