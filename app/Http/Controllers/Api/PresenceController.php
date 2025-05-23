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

    public function getModeByTime($setting)
    {
        $setting = Setting::first();
        $now = Carbon::now()->format('H:i');

        if ($now >= $setting->mulai_masuk_siswa && $now <= $setting->jam_masuk_siswa) {
            return 'jam_masuk';
        } elseif ($now >= $setting->jam_pulang_siswa && $now <= $setting->batas_pulang_siswa) {
            return 'jam_pulang';
        }
        return null;
    }

    public function presence(Request $request)
    {
        $setting = Setting::first();
        $mode = $this->getModeByTime($setting);

        $now = Carbon::now()->format('H:i');
        // Jika di luar jam absensi, tetap proses absen, status_masuk otomatis 'telat'
        if ($mode == 'jam_masuk') {
            $setting->mode = 'clock_in';
            $status_masuk = ($now > $setting->jam_masuk_siswa) ? 'telat' : 'tepat_waktu';
        } elseif ($mode == 'jam_pulang') {
            $setting->mode = 'clock_out';
            $status_masuk = null;
        } else {
            // Di luar jam absensi, anggap clock_in dan status_masuk telat
            $setting->mode = 'clock_in';
            $status_masuk = 'telat';
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
            'tanggal' => Carbon::now()->format('Y-m-d')
        ])->first();

        // Tentukan status presensi
        $status = $setting->mode == 'clock_in' ? 'absen_masuk' : 'absen_pulang';

        // Tentukan status_masuk
        if ($setting->mode == 'clock_in') {
            // Jika jam sekarang lebih dari jam_masuk_siswa, status_masuk = 'telat'
            $status_masuk = ($now > $setting->jam_masuk_siswa) ? 'telat' : 'tepat_waktu';
        } else {
            // clock_out atau mode lain, ambil dari data sebelumnya
            $status_masuk = $presenceData->status_masuk ?? 'telat';
        }

        // Siapkan data lengkap
        $data = [
            'device_id'     => $request->device_id,
            'tanggal'       => Carbon::now()->format('Y-m-d'),
            'status'        => $setting->mode == 'clock_in' ? 'absen_masuk' : 'absen_pulang',
            'jam_masuk'     => $setting->mode == 'clock_in' ? Carbon::now()->format('H:i:s') : ($presenceData->jam_masuk ?? null),
            'jam_pulang'    => $setting->mode == 'clock_out' ? Carbon::now()->format('H:i:s') : ($presenceData->jam_pulang ?? null),
            'status_masuk'  => $status_masuk,
            'keterangan'    => $presenceData->keterangan ?? null,
        ];

        // Jika mode clock_out dan sudah ada data absen masuk, update status dan jam_pulang
        if ($setting->mode == 'clock_out' && $presenceData) {
            $data['jam_masuk']    = $presenceData->jam_masuk; // tetap pakai jam_masuk lama
            $data['status_masuk'] = $presenceData->status_masuk;
            $data['status']       = 'absen_pulang';
            $data['jam_pulang']   = Carbon::now()->format('H:i:s');
        }

        // Simpan/update presensi
        $presence = AbsenSiswa::updateOrCreate([
            'siswa_id' => $siswa->id,
            'tanggal'  => Carbon::now()->format('Y-m-d')
        ], $data);

        return $setting->mode == "clock_in" ? "PRESENCE_CLOCK_IN_SAVED" : "PRESENCE_CLOCK_OUT_SAVED";
    }
}
