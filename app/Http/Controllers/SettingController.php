<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{

    public function index() {
        return view('pages.admin.settings.index');
    }


    public function update(SettingRequest $request, Setting $setting) {

        $keys = $request->except('_token');

        foreach ($keys as $key => $value) {
            Setting::set($key, $value);
        }
        session()->flash('success', ['Settings successfully updated']);

        return redirect()->back();
    }
}
