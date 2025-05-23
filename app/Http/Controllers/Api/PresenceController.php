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
        $deviceCount = Device::count();
        $deviceName = 'Device_' . ($deviceCount + 1);

        $device = Device::firstOrCreate(
            ['id' => $request->device_id],
            [
                'name' => $deviceName,
                'mode' => 'reader',
                'is_active' => 1
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
        $setting = Setting::first();
        $mode = $this->getModeByTime($setting);

        if ($mode == 'jam_masuk') {
            $setting->mode = 'clock_in';
        } elseif ($mode == 'jam_pulang') {
            $setting->mode = 'clock_out';
        } else {
            return response()->json(['message' => 'Di luar jam absensi'], 403);
        }

        // Device
        $device = Device::firstOrCreate(
            ['id' => $request->device_id],
            [
                'name' => 'Device_' . (Device::count() + 1),
                'mode' => 'reader',
                'is_active' => 1
            ]
        );

        if (!$device) {
            return "DEVICE_NOT_FOUND";
        }

        // Mode add_card: daftarkan RFID baru dan langsung presensi
        if ($device->mode == "add_card") {
            $rfid = Rfid::updateOrCreate(['code' => $request->rfid]);

            // Cek apakah sudah ada siswa dengan rfid ini
            $siswa = Siswa::where('rfid_id', $rfid->id)->first();
            if (!$siswa) {
                // Jika belum ada, bisa return pesan khusus atau lanjutkan sesuai kebutuhan
                return "RFID_REGISTERED_BUT_NO_STUDENT";
            }

            // Langsung proses presensi
            $presenceData = AbsenSiswa::where([
                'siswa_id' => $siswa->id,
                'date' => Carbon::now()->format('Y-m-d')
            ])->first();

            $data = [
                'device_id' => $request->device_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'present',
            ];

            $data[$setting->mode] = empty($presenceData->{$setting->mode}) ? Carbon::now()->format('H:i:s') : $presenceData->{$setting->mode};

            $presence = AbsenSiswa::updateOrCreate([
                'siswa_id' => $siswa->id,
                'tanggal' => Carbon::now()->format('Y-m-d')
            ], $data);

            return $setting->mode == "clock_in" ? "RFID_REGISTERED_AND_CLOCK_IN" : "RFID_REGISTERED_AND_CLOCK_OUT";
        }

        // Cari RFID
        $rfid = Rfid::where('code', $request->rfid)->first();
        if (!$rfid) {
            return "RFID_NOT_FOUND";
        }

        // Cari siswa berdasarkan rfid_id
        $siswa = Siswa::where('rfid_id', $rfid->id)->first();
        if (!$siswa) {
            return "RFID_NOT_FOUND";
        }

        // Cek data presensi hari ini
        $presenceData = AbsenSiswa::where([
            'siswa_id' => $siswa->id,
            'date' => Carbon::now()->format('Y-m-d')
        ])->first();

        $data = [
            'device_id' => $request->device_id,
            'date' => Carbon::now()->format('Y-m-d'),
            'status' => 'present',
        ];

        $data[$setting->mode] = empty($presenceData->{$setting->mode}) ? Carbon::now()->format('H:i:s') : $presenceData->{$setting->mode};

        $presence = AbsenSiswa::updateOrCreate([
            'siswa_id' => $siswa->id,
            'tanggal' => Carbon::now()->format('Y-m-d')
        ], $data);

        return $setting->mode == "clock_in" ? "PRESENCE_CLOCK_IN_SAVED" : "PRESENCE_CLOCK_OUT_SAVED";
    }
}
