<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\CountryRequest;

/**
 * Class CountryController
 * @package App\Http\Controllers
 */
class CountryController extends Controller {

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $countries = Country::orderBy('name')->get();

        return view('pages.admin.countries.index', compact('countries'));
    }

    /**
     * @param CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryRequest $request) {

        Country::create($request->only(['name', 'code', 'flat_rate']));

        session()->flash('success', ['Country successfully created']);

        return redirect()->back();
    }

    /**
     * @param CountryRequest $request
     * @param Country $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryRequest $request, Country $country) {

        $country->update($request->only(['name', 'code', 'flat_rate']));

        session()->flash('success', ['Country successfully updated']);

        return redirect()->back();
    }

    /**
     * @param Country $country
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Country $country) {

        $country->delete();

        session()->flash('success', ['Country successfully deleted']);

        return redirect()->back();
    }
}
