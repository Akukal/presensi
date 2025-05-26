<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run()
    {
        Guru::insert([
            [
                'id' => '9ef80ccc-ff2f-4f98-b9db-da46b50ef6d4',
                'nama' => 'Farah Wanodyatama, S.Pd.',
                'telepon' => '081234567890'
            ], [
                'id' => 'f62159a1-a638-47e8-9889-5df8a9d9bff7',
                'nama' => 'Sapta Nur Faiz, S.Pd.',
                'telepon' => '081324567890'
            ]
        ]);
    }
}