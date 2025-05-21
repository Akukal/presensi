<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\PositionRequest;
use DataTables;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view position|create position|edit position|delete position', ['only' => ['index']]);
        $this->middleware('permission:create position', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit position', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete position', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.position.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request)
    {
        Position::create($request->all());
        toastr('Position Created Successfully', 'success', 'Position', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('positions.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('website.position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request, Position $position)
    {
        $position->update($request->all());
        toastr('Position Updated Successfully', 'success', 'Position', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        toastr('Position Deleted Successfully', 'success', 'Position', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('positions.index');
    }

    public function datatable()
    {
        $positions = Position::orderBy('created_at', 'DESC');

        return DataTables::of($positions)
            ->addIndexColumn()
            ->editColumn('is_active', function($positions) {
                return $positions->is_active == 1 ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Non-Aktif</span>"; 
            })
            ->addColumn('action', function($positions) {
                $action = null;
                
                if(auth()->user()->hasPermissionTo('edit position')) {
                    $action .= '<a href="'.route('positions.edit', $positions->id).'" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>';
                }

                if(auth()->user()->hasPermissionTo('delete position')) {
                    $action .= '<button onclick="deleteConfirm(\''.$positions->id.'\')" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>
                    <form method="POST" action="'.route('positions.destroy', $positions->id).'" style="display:inline-block;" id="submit_'.$positions->id.'">
                        '.method_field('delete').csrf_field().'
                    </form>';
                }

                return empty($action) ? '-' : $action;
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
