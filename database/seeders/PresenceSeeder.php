<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Presence;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = -10; $i < 0; $i++) {
            Presence::insert([
                [
                    'id' => Uuid::uuid4()->toString(),
                    'staff_id' => '98a70bf2-3235-4cf8-8dae-be9dd83f050f',
                    'device_id' => '98a6ab06-b47f-4ae3-835d-8634cb66164a',
                    'date' => Carbon::now()->addDays($i),
                    'clock_in' => '08:00:00',
                    'clock_out' => '17:00:00',
                    'status' => 'present', 
                ],
                [
                    'id' => Uuid::uuid4()->toString(),
                    'staff_id' => '98a70bf2-35a5-4bee-966b-c45a74a80816',
                    'device_id' => '98a6ab06-b47f-4ae3-835d-8634cb66164a',
                    'date' => Carbon::now()->addDays($i),
                    'clock_in' => '08:00:00',
                    'clock_out' => '17:00:00',
                    'status' => 'present', 
                ],
                [
                    'id' => Uuid::uuid4()->toString(),
                    'staff_id' => '98a70bf2-370c-44e9-9884-33d8d9cd26a2',
                    'device_id' => '98a6ab06-b47f-4ae3-835d-8634cb66164a',
                    'date' => Carbon::now()->addDays($i),
                    'clock_in' => '08:00:00',
                    'clock_out' => '17:00:00',
                    'status' => 'present', 
                ],
                [
                    'id' => Uuid::uuid4()->toString(),
                    'staff_id' => '98a70bf2-38c9-4496-9e59-53610904de83',
                    'device_id' => '98a6ab06-b47f-4ae3-835d-8634cb66164a',
                    'date' => Carbon::now()->addDays($i),
                    'clock_in' => '08:00:00',
                    'clock_out' => '17:00:00',
                    'status' => 'present', 
                ],
                [
                    'id' => Uuid::uuid4()->toString(),
                    'staff_id' => '98a70bf2-3a46-45ff-a3f4-6d505eb59d60',
                    'device_id' => '98a6ab06-b47f-4ae3-835d-8634cb66164a',
                    'date' => Carbon::now()->addDays($i),
                    'clock_in' => '08:00:00',
                    'clock_out' => '17:00:00',
                    'status' => 'present', 
                ],
                [
                    'id' => Uuid::uuid4()->toString(),
                    'staff_id' => '98a70bf2-3ba1-4cc4-a359-062be00a0c51',
                    'device_id' => '98a6ab06-b47f-4ae3-835d-8634cb66164a',
                    'date' => Carbon::now()->addDays($i),
                    'clock_in' => '08:00:00',
                    'clock_out' => '17:00:00',
                    'status' => 'present', 
                ],
            ]);
        }
        
    }
}
