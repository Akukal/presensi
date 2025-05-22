<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        Siswa::create([
            'id' => '9ef80d36-1022-482a-9be1-2e03c4e82b79',
            'nis' => 4432,
            'nama' => 'Haikal Idris',
            'gender' => 1,
            'kelas_id' => '9ef80ced-c07c-4b96-b766-d3c73578d935',
            'telepon_wali' => '88297365487',
        ]);
    }
}