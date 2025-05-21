<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view setting|edit setting', ['only' => ['index']]);
        $this->middleware('permission:edit setting', ['only' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('website.setting.index', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        Setting::updateOrCreate([
            'id' => $request->id,
        ],[
            'mode' => $request->mode ? $request->mode : 'clock_in',
            'secret_key' => $request->new_secret_key ? Setting::quickRandom(16) : $request->secret_key
        ]);
        
        toastr('Setting Updated Successfully', 'success', 'Setting', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('settings.index');
    }
}
