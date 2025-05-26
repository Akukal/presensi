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

    Route::post('/dismiss-welcome-alert', function () {
        session(['welcome_alert_dismissed' => true]);
        return response()->json(['success' => true]);
    })->name('dismiss-welcome-alert');

    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas'])->except('show');
    Route::get('kelas/ajax/datatable', [KelasController::class, 'datatable'])->name('kelas.ajax.datatable');

    Route::resource('rfids', RfidController::class)->only(['index', 'destroy']);
    Route::get('rfids/ajax/datatable', [RfidController::class, 'datatable'])->name('rfids.ajax.datatable');

    Route::resource('siswa', SiswaController::class);
    Route::post('/siswa/daftar-rfid', [ SiswaController::class, 'daftarRfid'])->name('siswa.daftarRfid');
    Route::get('siswa/ajax/datatable', [SiswaController::class, 'datatable'])->name('siswa.ajax.datatable');

    Route::resource('guru', GuruController::class)->except('show');
    Route::get('guru/ajax/datatable', [GuruController::class, 'datatable'])->name('guru.ajax.datatable');

    Route::resource('devices', DeviceController::class)->except('show');
    Route::get('devices/ajax/datatable', [DeviceController::class, 'datatable'])->name('devices.ajax.datatable');

    Route::resource('users', UserController::class)->except('show');
    Route::get('users/ajax/datatable', [UserController::class, 'datatable'])->name('users.ajax.datatable');

    Route::resource('presences', PresenceController::class)->except('show');
    Route::get('presences/ajax/datatable', [PresenceController::class, 'datatable'])->name('presences.ajax.datatable');

    Route::resource('settings', SettingController::class)->only(['index', 'store', 'update']);

    Route::get('reports/date', [ReportController::class, 'reportDate'])->name('reports.date');
    Route::get('reports/date/ajax/datatable', [ReportController::class, 'reportDateDatatable'])->name('reports.date.ajax.datatable');
    Route::get('reports/date/export', [ReportController::class, 'reportDateExport'])->name('reports.date.export');

    Route::get('reports/rekap', [ReportController::class, 'rekapAbsensiSiswa'])->name('laporan.siswa.rekap');
    Route::get('reports/rekap/ajax/datatable', [ReportController::class, 'rekapAbsensiSiswaDatatable'])->name('laporan.siswa.rekap.ajax.datatable');
    Route::get('reports/rekap/export', [ReportController::class, 'rekapAbsensiSiswaExport'])->name('laporan.siswa.rekap.export');

    Route::get('reports/detail', [ReportController::class, 'detailAbsensiSiswa'])->name('laporan.siswa.detail');
    Route::get('reports/detail/ajax/datatable', [ReportController::class, 'detailAbsensiSiswaDatatable'])->name('laporan.siswa.detail.ajax.datatable');
    Route::get('reports/detail/export', [ReportController::class, 'detailAbsensiSiswaExport'])->name('laporan.siswa.detail.export');

    Route::get('reports/student', [ReportController::class, 'reportStudent'])->name('laporan.siswa');
    Route::get('reports/student/ajax/datatable', [ReportController::class, 'studentDatatable'])->name('laporan.siswa.ajax.datatable');
    Route::get('reports/student/{id}', [ReportController::class, 'studentPresence'])->name('laporan.siswa.detailpersiswa');
    Route::get('reports/student/{id}/ajax/datatable', [ReportController::class, 'studentPresenceDatatable'])->name('laporan.siswa.presensi.ajax.datatable');
    Route::get('reports/student/{id}/export', [ReportController::class, 'reportStudentExport'])->name('laporan.siswa.export');
});
