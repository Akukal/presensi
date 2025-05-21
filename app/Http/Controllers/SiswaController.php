<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Rfid;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Requests\SiswaRequest;
use DataTables;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view siswa|create siswa|edit siswa|delete siswa', ['only' => ['index', 'show']]);
        $this->middleware('permission:create siswa', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit siswa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete siswa', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('website.siswa.index');
    }

    public function create()
    {
        $kelas = Kelas::all();
        $rfids = Rfid::all();

        return view('website.siswa.create', compact('kelas', 'rfids'));
    }

    public function store(SiswaRequest $request)
    {
        // dd($request->all());
        Siswa::create($request->all());

        toastr('Siswa Created Successfully', 'success', 'Siswa');
        return redirect()->route('siswa.index');
    }

    public function show(Siswa $siswa)
    {
        return view('website.siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();

        return view('website.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        toastr('Siswa Updated Successfully', 'success', 'Siswa');

        return redirect()->route('siswa.index');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        toastr('Siswa Deleted Successfully', 'success', 'Siswa');

        return redirect()->route('siswa.index');
    }

    public function datatable()
    {
        $siswa = Siswa::with(['kelas', 'guru'])->orderBy('created_at', 'DESC');

        return DataTables::of($siswa)
            ->addIndexColumn()

            // NIS
            ->editColumn('nis', fn($s) => e($s->nis))

            // Nama
            ->editColumn('nama', fn($s) => e($s->nama))

            // Gender
            ->editColumn('gender', function ($s) {
                return $s->gender == 1
                    ? "<span class='badge badge-success'>Pria</span>"
                    : "<span class='badge badge-danger'>Wanita</span>";
            })
            
            // Kelas
            ->editColumn('kelas_id', fn($s) => $s->kelas?->nama ?? "<span class='badge badge-secondary'>No Kelas</span>")

            // Nomor Wali
            ->editColumn('telepon_wali', fn($s) => e($s->telepon_wali))

            // Guru
            ->addColumn('guru_telepon', fn($s) => $s->kelas?->guru?->telepon ?? "<span class='badge badge-secondary'>No Guru</span>")

            // RFID
            ->editColumn('code', function ($s) {
                return $s->code
                    ? e($s->code)
                    : "<span class='badge badge-danger'>No RFID yet</span>";
            })

            // Action Buttons
            ->addColumn('action', function ($s) {
                $action = '<a href="' . route('siswa.show', $s->id) . '" class="btn btn-info btn-sm m-1"><i class="fas fa-th"></i></a>';

                if (auth()->user()->hasPermissionTo('edit siswa')) {
                    $action .= '<a href="' . route('siswa.edit', $s->id) . '" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->hasPermissionTo('delete siswa')) {
                    $action .= '
                        <button onclick="deleteConfirm(\'' . $s->id . '\')" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>
                        <form method="POST" action="' . route('siswa.destroy', $s->id) . '" style="display:inline-block;" id="submit_' . $s->id . '">
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                }

                return $action;
            })

            ->rawColumns(['nis','nama', 'gender', 'kelas_id', 'telepon_wali', 'guru_telepon', 'code', 'action'])
            ->make(true);
    }
}
