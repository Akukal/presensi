<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AbsenSiswa;
use App\Models\Siswa;
use Carbon\Carbon;

class AbsenSiswaSeeder extends Seeder
{
    public function run()
    {
        $today = Carbon::now()->format('Y-m-d');
        $siswa = Siswa::all();

        // Siswa 1 - Hadir tepat waktu
        AbsenSiswa::create([
            'id' => '9ef80d36-1022-482a-9be1-2e03c4e82b80',
            'siswa_id' => $siswa[0]->id,
            'tanggal' => $today,
            'status' => 'absen_masuk',
            'jam_masuk' => '07:00:00',
            'status_masuk' => 'tepat_waktu',
            'keterangan' => 'Hadir tepat waktu'
        ]);

        // Siswa 2 - Terlambat
        AbsenSiswa::create([
            'id' => '9ef80d36-1022-482a-9be1-2e03c4e82b81',
            'siswa_id' => $siswa[1]->id,
            'tanggal' => $today,
            'status' => 'absen_masuk',
            'jam_masuk' => '08:30:00',
            'status_masuk' => 'telat',
            'keterangan' => 'Terlambat'
        ]);

        // Siswa 3 - Sakit
        AbsenSiswa::create([
            'id' => '9ef80d36-1022-482a-9be1-2e03c4e82b82',
            'siswa_id' => $siswa[2]->id,
            'tanggal' => $today,
            'status' => 'sakit',
            'keterangan' => 'Sakit'
        ]);
    }
} 