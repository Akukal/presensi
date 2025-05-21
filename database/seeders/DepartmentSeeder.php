<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            [
                "id" => "98a6ad0f-3334-4fa5-80b3-2515e7921d19",
                "created_at" => "2023-03-10 02:45:50",
                "updated_at" => "2023-03-10 02:45:50",
                "name" => "Human Resource",
                "is_active" => true
            ],
            [
                "id" => "98a6ad0f-3ac8-4a40-b3a9-9710ea8ba714",
                "created_at" => "2023-03-10 02:45:51",
                "updated_at" => "2023-03-10 02:45:51",
                "name" => "Human Capital",
                "is_active" => true
            ],
            [
                "id" => "98a6ad0f-3d0c-4586-8794-6bc84b17b073",
                "created_at" => "2023-03-10 02:45:52",
                "updated_at" => "2023-03-10 02:45:52",
                "name" => "Marketing",
                "is_active" => true
            ],
            [
                "id" => "98a6ad0f-3edd-468c-94cf-82f48b472994",
                "created_at" => "2023-03-10 02:45:53",
                "updated_at" => "2023-03-10 02:45:53",
                "name" => "Scrum Association",
                "is_active" => true
            ],
            [
                "id" => "98a6ad0f-4078-4e9c-a715-593df9952492",
                "created_at" => "2023-03-10 02:45:54",
                "updated_at" => "2023-03-10 02:45:54",
                "name" => "QA Engineer",
                "is_active" => true
            ],
            [
                "id" => "98a6ad0f-424c-4146-bceb-bea95327f8de",
                "created_at" => "2023-03-10 02:45:55",
                "updated_at" => "2023-03-10 02:45:55",
                "name" => "Software Engineer",
                "is_active" => true
            ]
        ]);
    }
}
