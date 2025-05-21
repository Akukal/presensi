<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;
use Carbon\Carbon;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Device::insert([
            [
                "id" => "98a6ab06-b47f-4ae3-835d-8634cb66164a",
                "created_at" => "2023-03-10 02:40:13",
                "updated_at" => "2023-03-10 02:40:13",
                "name" => "RFID Reader 1",
                "mode" => "reader",
                "is_active" => true
            ],
            [
                "id" => "98a6ab06-b9e7-4c3f-bb35-da42af0d65de",
                "created_at" => "2023-03-10 02:40:14",
                "updated_at" => "2023-03-10 02:40:14",
                "name" => "RFID Reader 2",
                "mode" => "reader",
                "is_active" => true
            ],
            [
                "id" => "98a6ab06-bbb6-4667-ac4b-ee3260ddf30e",
                "created_at" => "2023-03-10 02:40:15",
                "updated_at" => "2023-03-10 02:40:15",
                "name" => "RFID Reader 3",
                "mode" => "reader",
                "is_active" => true
            ],
            [
                "id" => "98a6ab06-be1c-49a9-9aee-9d7649131b97",
                "created_at" => "2023-03-10 02:40:16",
                "updated_at" => "2023-03-10 02:40:16",
                "name" => "RFID Reader 4",
                "mode" => "reader",
                "is_active" => true
            ],
            [
                "id" => "98a6ab06-c118-488d-8674-0bdea4e4ccce",
                "created_at" => "2023-03-10 02:40:17",
                "updated_at" => "2023-03-10 02:40:17",
                "name" => "RFID Reader 5",
                "mode" => "reader",
                "is_active" => true
            ]
        ]);
    }
}
