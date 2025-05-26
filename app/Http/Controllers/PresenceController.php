<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Http\Requests\PresenceRequest;

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view presence|create presence', ['only' => 'index']);
        $this->middleware('permission:create presence', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.presence.index');
    }

    public function create()
    {
        return view('website.presence.create');
    }

    public function store(PresenceRequest $request)
    {
        AbsenSiswa::create($request->all());
        toastr('Presence Created Successfully', 'success', 'Presence');
        return redirect()->route('presences.index');
    }

    public function datatable()
    {
        $presensi = AbsenSiswa::with(['siswa.kelas'])->where('tanggal', Carbon::now()->format('Y-m-d'))->orderBy('created_at', 'DESC');

        return DataTables::of($presensi)
            ->addIndexColumn()
            ->editColumn('nama', function ($presensi) {
                return $presensi->siswa->nama ?? '-';
            })
            ->editColumn('kelas', function ($presensi) {
                return $presensi->siswa->kelas->nama ?? '-';
            })
            ->editColumn('status', function ($presensi) {
                switch ($presensi->status) {
                    case 'absen_masuk':
                        return 'Absen Masuk';
                    case 'absen_pulang':
                        return 'Absen Pulang';
                    case 'tidak_absen_masuk':
                        return 'Tidak Absen Masuk';
                    case 'tidak_absen_pulang':
                        return 'Tidak Absen Pulang';
                    default:
                        return '-';
                }
            })
            ->editColumn('tanggal', function ($presensi) {
                return $presensi->tanggal ? Carbon::parse($presensi->tanggal)->format('d-m-Y') : '-';
            })
            ->editColumn('jam_masuk', function ($presensi) {
                return $presensi->jam_masuk ? Carbon::parse($presensi->jam_masuk)->format('H:i:s') : '-';
            })
            ->editColumn('jam_pulang', function ($presensi) {
                return $presensi->jam_pulang ? Carbon::parse($presensi->jam_pulang)->format('H:i:s') : '-';
            })
            ->editColumn('status_masuk', function ($presensi) {
                switch ($presensi->status_masuk) {
                    case 'tepat_waktu':
                        return 'Tepat Waktu';
                    case 'telat':
                        return 'Terlambat';
                    case 'alfa':
                        return 'Alfa';
                    case 'izin':
                        return 'Izin';
                    case 'sakit':
                        return 'Sakit';
                    default:
                        return '-';
                }
            })
            ->rawColumns(['status_masuk', 'status', 'tanggal', 'jam_masuk', 'jam_pulang', 'status_masuk', 'nama', 'kelas'])
            ->make(true);
    }
}
