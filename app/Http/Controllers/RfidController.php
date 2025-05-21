<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use Illuminate\Http\Request;
use App\Http\Requests\RfidRequest;
use DataTables;

class RfidController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view rfid|delete rfid', ['only' => ['index']]);
        $this->middleware('permission:delete rfid', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.rfid.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rfid $rfid)
    {
        $rfid->delete();
        toastr('RFID Deleted Successfully', 'success', 'RFID', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('rfids.index');
    }

    public function datatable()
    {
        $rfids = Rfid::orderBy('created_at', 'DESC');

        return DataTables::of($rfids)
            ->addIndexColumn()
            ->editColumn('is_active', function($rfids) {
                return $rfids->is_active == 0 ? "<span class='badge badge-success'>Ready To Use</span>" : "<span class='badge badge-danger'>Non-Aktif</span>"; 
            })
            ->addColumn('action', function($rfids) {
                $action = '';

                if(auth()->user()->hasPermissionTo('delete rfid')) {
                $action .= '<button onclick="deleteConfirm(\''.$rfids->id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    <form method="POST" action="'.route('rfids.destroy', $rfids->id).'" style="display:inline-block;" id="submit_'.$rfids->id.'">
                        '.method_field('delete').csrf_field().'
                    </form>';
                }

                return empty($action) ? '-' : $action;
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
