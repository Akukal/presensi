<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Presence;
use App\Models\Staff;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PresenceDateExport;
use App\Exports\PresenceStaffExport;
use Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view presence by date', ['only' => ['reportDate']]);
        $this->middleware('permission:view presence by staff', ['only' => ['reportStaff']]);
    }

    public function reportDate()
    {
        return view('website.report.date');
    }

    public function reportDateDatatable(Request $request)
    {
        $prensences = Presence::query();
        if(isset($request->date) && !empty($request->date)) $prensences->where('date', $request->date);
        $prensences->with(['staff', 'staff.department', 'staff.position'])->orderBy('date', 'DESC');

        return DataTables::of($prensences)
            ->addIndexColumn()
            ->editColumn('clock_out', function($data) {
                return empty($data->clock_out) ? '-' : $data->clock_out; 
            })
            ->make(true);
    }

    public function reportDateExport(Request $request)
    {
        $date = Carbon::parse($request->date);
        $prensences = Presence::where('date', $request->date)->with(['staff', 'staff.department', 'staff.position'])->orderBy('date', 'DESC')->get();

        if($request->submit == "pdf") {
            $pdf = Pdf::loadView('website.report.report_date_pdf', ['presences' => $prensences, 'date' => $date])->setPaper('a4', 'landscape');
            return $pdf->stream();
        }

        if($request->submit == "excel") {
            return Excel::download(new PresenceDateExport($prensences, $date), 'presence_report_'.$date->format('d_F_Y').'.xlsx');
        }
    }

    public function reportStaff()
    {
        return view('website.report.staff');
    }

    public function staffDatatable()
    {
        $staff = Staff::with(['department', 'position'])->orderBy('created_at', 'DESC');

        return DataTables::of($staff)
            ->addIndexColumn()
            ->editColumn('gender', function($data) {
                return $data->gender == 1 ? "<span class='badge badge-success'>Male</span>" : "<span class='badge badge-danger'>Female</span>"; 
            })
            ->addColumn('action', function($data){
                return '<a href="'.route('reports.staff.presences', $data->id).'" class="btn btn-info btn-sm"><i class="fas fa-th"></i></a>';
            })
            ->rawColumns(['action','gender', 'code'])
            ->make(true);
    }

    public function staffPresence($id)
    {
        $staff = Staff::with(['department', 'position'])->find($id);
        return view('website.report.staff_presence', compact('staff'));
    }

    public function staffPresenceDatatable(Request $request, $id)
    {
        $prensences = Presence::query();
        if(!empty($request->start_date) && !empty($request->end_date)) $prensences->whereBetween('date', [$request->start_date, $request->end_date]);
        $prensences->where('staff_id', $id)->orderBy('date', 'DESC');

        return DataTables::of($prensences)
            ->addIndexColumn()
            ->editColumn('clock_out', function($data) {
                return empty($data->clock_out) ? '-' : $data->clock_out; 
            })
            ->make(true);
    }

    public function reportStaffExport(Request $request, $id)
    {
        $staff = Staff::with(['department', 'position'])->find($id);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $prensences = Presence::where('staff_id', $id)->whereBetween('date', [$request->start_date, $request->end_date])->orderBy('date', 'DESC')->get();

        if($request->submit == "pdf") {
            $pdf = Pdf::loadView('website.report.report_staff_pdf', ['presences' => $prensences,'startDate' => $startDate,'endDate' => $endDate,'staff' => $staff])->setPaper('a4', 'landscape');

            return $pdf->stream();
        }

        if($request->submit == "excel") {
            return Excel::download(new PresenceStaffExport($prensences, $startDate, $endDate, $staff), 'presence_report_'.$staff->name.'.xlsx');
        }
    }
}
