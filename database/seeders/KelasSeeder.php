<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::create([
            'id' => '9ef80ced-c07c-4b96-b766-d3c73578d935',
            'nama' => 'XI PPLG 1',
            'guru_id' => '9ef80ccc-ff2f-4f98-b9db-da46b50ef6d4',
        ]);
    }
}