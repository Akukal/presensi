<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Presence;
use App\Models\Siswa;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Carbon::setLocale('id'); 
        $today = Carbon::now()->translatedFormat('d F Y');
        $kelasActivated = Kelas::count();
        $guruActivated = Guru::count();
        $siswaActivated = Siswa::count();

        $clockInToday = AbsenSiswa::where('tanggal', $today)->whereNotNull('jam_masuk')->get()->count();
        $clockOutToday = AbsenSiswa::where('tanggal', $today)->whereNotNull('jam_pulang')->count();
        
        $chartKelasCount = Kelas::orderBy('created_at', 'DESC')->withCount('siswa')->pluck('siswa_count');
        $chartKelasLabel = Kelas::orderBy('created_at', 'DESC')->pluck('nama');
        
        return view('website.dashboard.index')->with([
            'today'=> $today,
            'kelasActivated' => $kelasActivated,
            'guruActivated' => $guruActivated,
            'siswaActivated' => $siswaActivated,
            'clockInToday' => $clockInToday,
            'clockOutToday' => $clockOutToday,
            'chartKelasCount' => $chartKelasCount,
            'chartKelasLabel' => $chartKelasLabel,
        ]);
    }
}
