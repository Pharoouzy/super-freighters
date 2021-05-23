<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use App\Http\Requests\ModeRequest;

class ModeController extends Controller {

    public function index() {
        $modes = Mode::orderBy('name')->get();

        return view('pages.admin.modes.index', compact('modes'));
    }

   public function store(ModeRequest $request) {

        Mode::create($request->only(['name', 'base_fare', 'fare_per_kg', 'expected_arrival_day']));

        session()->flash('success', ['Mode of Transport successfully created']);

       return redirect()->back();
    }


    public function update(ModeRequest $request, Mode $mode) {

        $mode->update($request->only(['name', 'base_fare', 'fare_per_kg', 'expected_arrival_day']));

        session()->flash('success', ['Mode of Transport successfully updated']);

        return redirect()->back();
    }

    public function destroy(Mode $mode) {

        $mode->delete();

        session()->flash('success', ['Mode of Transport successfully deleted']);

        return redirect()->back();
    }
}
