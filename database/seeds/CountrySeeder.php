<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder {

    private $countries = [
        [
            'code' => 'US',
            'name' => 'United States of America',
            'flat_rate' => 1500,
        ],
        [
            'code' => 'UK',
            'name' => 'United Kingdom',
            'flat_rate' => 800,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Country::insert($this->countries);
    }
}
