<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run()
    {
        Guru::create([
            'id' => '9ef80ccc-ff2f-4f98-b9db-da46b50ef6d4',
            'nama' => 'Farah Wanodyatama, S.Pd',
            'telepon' => '81234567890',
        ]);
    }
}