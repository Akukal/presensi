<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Rfid;
use App\Models\AbsenSiswa;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function changeMode(Request $request)
    {
        $setting = Setting::first();
        // Otomatis buat device jika belum ada
        $device = Device::firstOrCreate(
            ['id' => $request->device_id],
            [
                // Tambahkan kolom lain jika perlu, misal:
                // 'nama' => $request->device_name ?? 'Unknown',
                // 'mode' => 'reader'
            ]
        );

        if (!$setting) {
            return "SECRET_KEY_NOT_FOUND";
        }

        $device->update([
            'mode' => $device->mode == "add_card" ? "reader" : "add_card"
        ]);

        return $device->mode == "add_card" ? "CARD_ADD_MODE" : "READER_MODE";
    }

    public function presence(Request $request)
    {
        // Tidak perlu cek secret_key jika ingin semua device bisa request
        $setting = Setting::first();
        // menentukan mode jam masuk atau jam pulang
        $mode = $this->getModeByTime($setting);
        // Gunakan $mode untuk menentukan proses selanjutnya
        // Contoh:
        if ($mode == 'jam_masuk') {
            // Proses absen masuk
        } elseif ($mode == 'jam_pulang') {
            // Proses absen pulang
        } else {
            return response()->json(['message' => 'Di luar jam absensi'], 403);
        }
        // Otomatis buat device jika belum ada
        $device = Device::firstOrCreate(
            ['id' => $request->device_id],
            [
                'name' => 'Device_' . (Device::count() + 1),
                'mode' => 'reader',
                'is_active' => 1
            ]
        );
        $siswa = Siswa::where('code', $request->rfid)->first();

        if (!$device) {
            return "DEVICE_NOT_FOUND";
        }

        if ($device->mode == "add_card") {
            Rfid::updateOrCreate(['code' => $request->rfid]);
            return "RFID_REGISTERED";
        } else {
            if (!$siswa) {
                return "RFID_NOT_FOUND";
            }

            $presenceData = AbsenSiswa::where([
                'staff_id' => $siswa->id,
                'date' => Carbon::now()->format('Y-m-d')
            ])->first();

            $data = [
                'device_id' => $request->device_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'present',
            ];

            $data[$setting->mode] = empty($presenceData->{$setting->mode}) ? Carbon::now()->format('H:i:s') : $presenceData->{$setting->mode};

            $presence = AbsenSiswa::updateOrCreate([
                'staff_id' => $siswa->id,
                'date' => Carbon::now()->format('Y-m-d')
            ], $data);

            return $setting->mode == "clock_in" ? "PRESENCE_CLOCK_IN_SAVED" : "PRESENCE_CLOCK_OUT_SAVED";
        }
    }
}
