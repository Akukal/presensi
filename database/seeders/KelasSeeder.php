<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::insert([
            [
                'id' => '9ef80ced-c07c-4b96-b766-d3c73578d935',
                'nama' => 'XI PPLG 1',
                'guru_id' => '9ef80ccc-ff2f-4f98-b9db-da46b50ef6d4',
            ], [
                'id' => '939d358b-b746-4e3e-8845-59d94461ab80',
                'nama' => 'XI PPLG 2',
                'guru_id' => 'f62159a1-a638-47e8-9889-5df8a9d9bff7'
            ]
        ]);
    }
}