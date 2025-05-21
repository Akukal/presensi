<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Rfid;
use App\Models\Kelas;
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        $rfids = Rfid::all();

        return view('website.siswa.create', compact('kelas', 'rfids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiswaRequest $request)
    {
        Siswa::create($request->all());
        Rfid::where('code', $request->code)->delete();
        
        toastr('Siswa Created Successfully', 'success', 'Siswa');

        return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('website.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();

        return view('website.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        toastr('Siswa Updated Successfully', 'success', 'Siswa');

        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        toastr('Siswa Deleted Successfully', 'success', 'Siswa');

        return redirect()->route('siswa.index');
    }

    public function datatable()
    {
        $siswa = Siswa::with(['kelas'])->orderBy('created_at', 'DESC');

        return DataTables::of($siswa)
            ->addIndexColumn()
            ->editColumn('gender', function($siswa) {
                return $siswa->gender == 1 ? "<span class='badge badge-success'>Male</span>" : "<span class='badge badge-danger'>Female</span>"; 
            })
            ->editColumn('code', function($siswa) {
                return $siswa->code ? $siswa->code : "<span class='badge badge-danger'>No rfid yet</span>"; 
            })
            ->addColumn('action', function($siswa){
                $action = '<a href="'.route('siswa.show', $siswa->id).'" class="btn btn-info btn-sm m-1"><i class="fas fa-th"></i> </a>';

                if(auth()->user()->hasPermissionTo('edit siswa')) {
                    $action .= '<a href="'.route('siswa.edit', $siswa->id).'" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>';
                }

                if(auth()->user()->hasPermissionTo('delete siswa')) {
                    $action .= '<button onclick="deleteConfirm(\''.$siswa->id.'\')" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>
                    <form method="POST" action="'.route('siswa.destroy', $siswa->id).'" style="display:inline-block;" id="submit_'.$siswa->id.'">
                        '.method_field('delete').csrf_field().'
                    </form>';
                }

                return $action;
            })
            ->rawColumns(['action','gender', 'code'])
            ->make(true);
    }
}