<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', DashboardController::class)->name('home');

    Route::resource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ])->except('show');
    Route::get('kelas/ajax/datatable', [KelasController::class, 'datatable'])->name('kelas.ajax.datatable');

    Route::resource('rfids', RfidController::class)->only(['index', 'destroy']);
    Route::get('rfids/ajax/datatable', [RfidController::class, 'datatable'])->name('rfids.ajax.datatable');

    Route::resource('siswa', SiswaController::class);
    Route::get('siswa/ajax/datatable', [SiswaController::class, 'datatable'])->name('siswa.ajax.datatable');

    Route::resource('guru', GuruController::class);
    Route::get('guru/ajax/datatable', [GuruController::class, 'datatable'])->name('guru.ajax.datatable');

    Route::resource('devices', DeviceController::class)->except('show');
    Route::get('devices/ajax/datatable', [DeviceController::class, 'datatable'])->name('devices.ajax.datatable');

    Route::resource('users', UserController::class)->except('show');
    Route::get('users/ajax/datatable', [UserController::class, 'datatable'])->name('users.ajax.datatable');

    Route::resource('presences', PresenceController::class)->only(['index', 'create', 'store']);
    Route::get('presences/ajax/datatable', [PresenceController::class, 'datatable'])->name('presences.ajax.datatable');

    Route::resource('settings', SettingController::class)->only(['index', 'store']);

    Route::get('reports/date', [ReportController::class, 'reportDate'])->name('reports.date');
    Route::get('reports/date/ajax/datatable', [ReportController::class, 'reportDateDatatable'])->name('reports.date.ajax.datatable');
    Route::get('reports/date/export', [ReportController::class, 'reportDateExport'])->name('reports.date.export');

    Route::get('reports/staff', [ReportController::class, 'reportStaff'])->name('reports.staff');
    Route::get('reports/staff/ajax/datatable', [ReportController::class, 'staffDatatable'])->name('reports.staff.ajax.datatable');
    Route::get('reports/staff/{id}/presences', [ReportController::class, 'StaffPresence'])->name('reports.staff.presences');
    Route::get('reports/staff/{id}/presences/ajax/datatable', [ReportController::class, 'staffPresenceDatatable'])->name('reports.staff.presences.ajax.datatable');
    Route::get('reports/staff/{id}/presences/export', [ReportController::class, 'reportStaffExport'])->name('reports.staff.export');
});
