<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::insert([
            [
                "id" => "98a70bf2-3235-4cf8-8dae-be9dd83f050f",
                "created_at" => "2023-03-10 07:11:13",
                "updated_at" => "2023-03-10 07:13:23",
                "department_id" => "98a6ad0f-3334-4fa5-80b3-2515e7921d19",
                "position_id" => "98a6ae9b-cafc-482d-8dba-6f5569591b64",
                "code" => "8123110259",
                "name" => "Dede Rusliandi",
                "gender" => 1,
                "birth_of_date" => "2023-01-01",
                "address" => "Bandung, Jawa Barat, Indonesia",
                "phone_number" => "081223230981",
                "start_date" => "2021-10-01"
            ],
            [
                "id" => "98a70bf2-35a5-4bee-966b-c45a74a80816",
                "created_at" => "2023-03-10 07:11:13",
                "updated_at" => "2023-03-10 07:13:34",
                "department_id" => "98a6ad0f-3ac8-4a40-b3a9-9710ea8ba714",
                "position_id" => "98a6ae9b-cd25-44da-84bf-adf063c56ada",
                "code" => "14441832",
                "name" => "Hadian Rahmat",
                "gender" => 1,
                "birth_of_date" => "2023-01-02",
                "address" => "Bandung, Jawa Barat, Indonesia",
                "phone_number" => "081223230982",
                "start_date" => "2021-10-02"
            ],
            [
                "id" => "98a70bf2-370c-44e9-9884-33d8d9cd26a2",
                "created_at" => "2023-03-10 07:11:13",
                "updated_at" => "2023-03-10 07:13:41",
                "department_id" => "98a6ad0f-3d0c-4586-8794-6bc84b17b073",
                "position_id" => "98a6ae9b-c8a7-467a-9f80-6a739f5b1e34",
                "code" => "55158195252",
                "name" => "Rizky Alfa Uji", 
                "gender" => 1,
                "birth_of_date" => "2023-01-03",
                "address" => "Bandung, Jawa Barat, Indonesia",
                "phone_number" => "081223230983",
                "start_date" => "2021-10-03"
            ],
            [
                "id" => "98a70bf2-38c9-4496-9e59-53610904de83",
                "created_at" => "2023-03-10 07:11:13",
                "updated_at" => "2023-03-10 07:13:51",
                "department_id" => "98a6ad0f-3edd-468c-94cf-82f48b472994",
                "position_id" => "98a6ae9b-cd25-44da-84bf-adf063c56ada",
                "code" => "26399190132640",
                "name" => "Iqbal Dzulfikar",
                "gender" => 1,
                "birth_of_date" => "2023-01-04",
                "address" => "Bandung, Jawa Barat, Indonesia",
                "phone_number" => "081223230984",
                "start_date" => "2021-10-04"
            ],
            [
                "id" => "98a70bf2-3a46-45ff-a3f4-6d505eb59d60",
                "created_at" => "2023-03-10 07:11:13",
                "updated_at" => "2023-03-10 07:13:57",
                "department_id" => "98a6ad0f-4078-4e9c-a715-593df9952492",
                "position_id" => "98a6ae9b-cd25-44da-84bf-adf063c56ada",
                "code" => "336917172",
                "name" => "Defana Aditya",
                "gender" => 1,
                "birth_of_date" => "2023-01-01",
                "address" => "Bandung, Jawa Barat, Indonesia",
                "phone_number" => "081223230985",
                "start_date" => "2021-10-05"
            ],
            [
                "id" => "98a70bf2-3ba1-4cc4-a359-062be00a0c51",
                "created_at" => "2023-03-10 07:11:13",
                "updated_at" => "2023-03-10 07:14:02",
                "department_id" => "98a6ad0f-424c-4146-bceb-bea95327f8de",
                "position_id" => "98a6ae9b-cd25-44da-84bf-adf063c56ada",
                "code" => "51411712112432250",
                "name" => "Aditya Aria",
                "gender" => 1,
                "birth_of_date" => "2023-01-01",
                "address" => "Bandung, Jawa Barat, Indonesia",
                "phone_number" => "081223230986",
                "start_date" => "2021-10-06"
            ]
        ]);
    }
}
