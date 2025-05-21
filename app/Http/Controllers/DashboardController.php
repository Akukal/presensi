<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;
use App\Models\Staff;
use App\Models\Device;
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
        $today = Carbon::now()->format('Y-m-d');
        $kelasActivated = Kelas::count();
        $siswaActivated = Siswa::count();
        $deviceActivated = Device::where('is_active', true)->count();
        $clockInToday = AbsenSiswa::where('tanggal', $today)->whereNotNull('jam_masuk')->count();
        $clockOutToday = AbsenSiswa::where('tanggal', $today)->whereNotNull('jam_pulang')->count();
        
        $chartKelasCount = Kelas::orderBy('created_at', 'DESC')->withCount('siswa')->pluck('siswa_count');
        $chartKelasLabel = Kelas::orderBy('created_at', 'DESC')->pluck('nama');
        
        return view('website.dashboard.index')->with([
            'kelasActivated' => $kelasActivated,
            'siswaActivated' => $siswaActivated,
            'deviceActivated' => $deviceActivated,
            'clockInToday' => $clockInToday,
            'clockOutToday' => $clockOutToday,
            'chartKelasCount' => $chartKelasCount,
            'chartKelasLabel' => $chartKelasLabel,
        ]);
    }
}
