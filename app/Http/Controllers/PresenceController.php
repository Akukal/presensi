<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view presence', ['only' => ['index']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.presence.index');
    }

    public function datatable()
    {
        $prensences = AbsenSiswa::with(['siswa', 'siswa.kelas'])->where('tanggal', Carbon::now()->format('Y-m-d'))->orderBy('created_at', 'DESC');

        return DataTables::of($prensences)
            ->addIndexColumn()
            ->editColumn('jam_keluar', function($data) {
                return empty($data->jam_keluar) ? '-' : $data->jam_keluar; 
            })
            ->make(true);
    }
}
