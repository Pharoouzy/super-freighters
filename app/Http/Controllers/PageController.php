<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\CountryRequest;
use App\Models\Mode;

class PageController extends Controller {

    public function index() {

        $countries = Country::orderBy('name')->get();

        $modes = Mode::orderBy('name')->get();

        return view('pages.app.home', compact('countries', 'modes'));
    }
}
