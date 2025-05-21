<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Requests\DeviceRequest;
use DataTables;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view device|create device|edit device|delete device', ['only' => ['index']]);
        $this->middleware('permission:create device', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit device', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete device', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.device.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.device.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceRequest $request)
    {
        Device::create($request->all());
        toastr('Device Created Successfully', 'success', 'Device', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('devices.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        return view('website.device.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceRequest $request, Device $device)
    {
        $device->update($request->all());
        toastr('Device Updated Successfully', 'success', 'Device', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();
        toastr('Device Deleted Successfully', 'success', 'Device', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('devices.index');
    }

    public function datatable()
    {
        $devices = Device::orderBy('created_at', 'DESC');

        return DataTables::of($devices)
            ->addIndexColumn()
            ->editColumn('is_active', function($devices) {
                return $devices->is_active == 1 ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Non-Aktif</span>"; 
            })
            ->addColumn('action', function($devices) {
                $action = '';

                if(auth()->user()->hasPermissionTo('edit device')) {
                    $action .= '<a href="'.route('devices.edit', $devices->id).'" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>';
                }

                if(auth()->user()->hasPermissionTo('delete device')) {
                    $action .= '<button onclick="deleteConfirm(\''.$devices->id.'\')" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>
                    <form method="POST" action="'.route('devices.destroy', $devices->id).'" style="display:inline-block;" id="submit_'.$devices->id.'">
                        '.method_field('delete').csrf_field().'
                    </form>';
                }

                return empty($action) ? '-' : $action;
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
