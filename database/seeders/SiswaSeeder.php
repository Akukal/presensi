<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        Siswa::insert([
            [
                'id' => '9ef80d36-1022-482a-9be1-2e03c4e82b79',
                'nis' => 4432,
                'nama' => 'Haikal Idris',
                'gender' => 1,
                'kelas_id' => '9ef80ced-c07c-4b96-b766-d3c73578d935',
                'telepon_wali' => '087654321010',
            ], [
                'id' => '6ea405e8-9649-4258-95f3-238adb0b978e',
                'nis' => 4419,
                'nama' => 'Anggatra Satya P.N.',
                'gender' => 1,
                'kelas_id' => '9ef80ced-c07c-4b96-b766-d3c73578d935',
                'telepon_wali' => '087654321011',
            ], [
                'id' => 'b774048f-14f5-4fc7-a1d1-86c9dd521451',
                'nis' => 4477,
                'nama' => 'M. Fazry Al Gaza',
                'gender' => 1,
                'kelas_id' => '939d358b-b746-4e3e-8845-59d94461ab80',
                'telepon_wali' => '087654321012',
            ]
        ]);
    }
}