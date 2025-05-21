<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Requests\KelasRequest;
use App\Models\Guru;
use DataTables;
use Auth;

class kelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view kelas|create kelas|edit kelas|delete kelas', ['only' => ['index']]);
        $this->middleware('permission:create kelas', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit kelas', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete kelas', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('website.kelas.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelasRequest $request)
    {
        Kelas::create($request->all());
        toastr('kelas Created Successfully', 'success', 'kelas');

        return redirect()->route('kelas.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('website.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelasRequest $request, kelas $kelas)
    {
        $kelas->update($request->all());
        toastr('kelas Updated Successfully', 'success', 'kelas');

        return redirect()->route('kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        toastr('kelas Deleted Successfully', 'success', 'kelas');

        return redirect()->route('kelas.index');
    }

    public function datatable()
    {
        $kelas = Kelas::orderBy('created_at', 'DESC');

        return DataTables::of($kelas)
            ->addIndexColumn()
            ->editColumn('is_active', function($kelas) {
                return $kelas->is_active == 1 ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Non-Aktif</span>"; 
            })
            ->addColumn('action', function($kelas) {
                $action = null;

                if(auth()->user()->hasPermissionTo('edit kelas')) {
                    $action .= '<a href="'.route('kelas.edit', $kelas->id).'" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>';
                }

                if(auth()->user()->hasPermissionTo('delete kelas')) {
                    $action .= '<button onclick="deleteConfirm(\''.$kelas->id.'\')" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>
                    <form method="POST" action="'.route('kelas.destroy', $kelas->id).'" style="display:inline-block;" id="submit_'.$kelas->id.'">
                        '.method_field('delete').csrf_field().'
                    </form>';
                }

                return empty($action) ? '-' : $action;
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}