<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view setting|edit setting', ['only' => ['index']]);
        $this->middleware('permission:edit setting', ['only' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('website.setting.index', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        Setting::updateOrCreate([
            'id' => $request->id,
        ], [
            'secret_key' => $request->new_secret_key ? Setting::quickRandom(16) : $request->secret_key,
            'mulai_masuk_siswa' => $request->mulai_masuk_siswa,
            'jam_masuk_siswa' => $request->jam_masuk_siswa,
            'jam_pulang_siswa' => $request->jam_pulang_siswa,
            'batas_pulang_siswa' => $request->batas_pulang_siswa,
        ]);

        toastr('Setting Updated Successfully', 'success', 'Setting');
        return redirect()->route('settings.index');
    }

    public function getModeByTime($setting)
    {
        $now = Carbon::now()->format('H:i');

        if ($now >= $setting->mulai_masuk_siswa && $now <= $setting->jam_masuk_siswa) {
            return 'jam_masuk'; // Mode masuk
        } elseif ($now >= $setting->jam_pulang_siswa && $now <= $setting->batas_pulang_siswa) {
            return 'jam_pulang'; // Mode pulang
        }
        // Default mode jika di luar jam
        return 'none';
    }
}
