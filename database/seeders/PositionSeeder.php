<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
use Carbon\Carbon;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::insert([
            [
                "id" => "98a6ae9b-c03f-45f0-96b9-d0fcb67fcfe0",
                "created_at" => "2023-03-10 02:50:14",
                "updated_at" => "2023-03-10 02:50:14",
                "name" => "CEO",
                "is_active" => true
            ],
            [
                "id" => "98a6ae9b-c4bd-4147-beb1-e79d942f6b8c",
                "created_at" => "2023-03-10 02:50:15",
                "updated_at" => "2023-03-10 02:50:15",
                "name" => "CTO",
                "is_active" => true
            ],
            [
                "id" => "98a6ae9b-c6c4-4939-90f3-fbc0838c3dc0",
                "created_at" => "2023-03-10 02:50:16",
                "updated_at" => "2023-03-10 02:50:16",
                "name" => "CFO",
                "is_active" => true
            ],
            [
                "id" => "98a6ae9b-c8a7-467a-9f80-6a739f5b1e34",
                "created_at" => "2023-03-10 02:50:17",
                "updated_at" => "2023-03-10 02:50:17",
                "name" => "CMO",
                "is_active" => true
            ],
            [
                "id" => "98a6ae9b-cafc-482d-8dba-6f5569591b64",
                "created_at" => "2023-03-10 02:50:18",
                "updated_at" => "2023-03-10 02:50:18",
                "name" => "Manager",
                "is_active" => true
            ],
            [
                "id" => "98a6ae9b-cd25-44da-84bf-adf063c56ada",
                "created_at" => "2023-03-10 02:50:19",
                "updated_at" => "2023-03-10 02:50:19",
                "name" => "Staff",
                "is_active" => true
            ]
        ]);
    }
}
