<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Rfid;
use App\Models\Presence;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function changeMode(Request $request)
    {
        $setting = Setting::first();
        $device = Device::find($request->device_id);

        if($setting->secret_key != $request->secret_key) {
            return "SECRET_KEY_NOT_FOUND";
        }

        if(!$device) {
            return "DEVICE_NOT_FOUND";
        }

        $device->update([
            'mode' => $device->mode == "add_card" ? "reader" : "add_card"
        ]);

        return $device->mode == "add_card" ? "CARD_ADD_MODE" : "READER_MODE";
    }

    public function presence(Request $request)
    {
        $setting = Setting::first();
        $device = Device::find($request->device_id);
        $siswa = Siswa::where('code', $request->rfid)->first();

        if($setting->secret_key != $request->secret_key) {
            return "SECRET_KEY_NOT_FOUND";
        }

        if(!$device) {
            return "DEVICE_NOT_FOUND";
        }

        if($device->mode == "add_card") {
            Rfid::updateOrCreate(['code' => $request->rfid]);
            return "RFID_REGISTERED";
        } else {
            if(!$siswa) {
                return "RFID_NOT_FOUND";
            }
    
            $presenceData = Presence::where(['staff_id' => $siswa->id, 'date' => Carbon::now()->format('Y-m-d')])->first();
    
            $data = [
                'device_id' => $request->device_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'present',
            ];
    
            $data[$setting->mode] = empty($presenceData->{$setting->mode}) ? Carbon::now()->format('H:i:s') : $presenceData->{$setting->mode};
    
            $presence = Presence::updateOrCreate([
                'staff_id' => $siswa->id,
                'date' => Carbon::now()->format('Y-m-d')
            ], $data);
    
            return $setting->mode == "clock_in" ? "PRESENCE_CLOCK_IN_SAVED" : "PRESENCE_CLOCK_OUT_SAVED";
        }
    }
}
