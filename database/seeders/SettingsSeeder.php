<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'id' => Str::uuid(),
            'mulai_masuk_siswa' => '05:00:00',
            'jam_masuk_siswa' => '06:30:00',
            'jam_pulang_siswa' => '14:30:00',
            'batas_pulang_siswa' => '17:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
