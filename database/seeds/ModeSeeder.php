<?php

use App\Models\Mode;
use Illuminate\Database\Seeder;

class ModeSeeder extends Seeder {

    private $modes = [
        [
            'name' => 'Air',
            'base_fare' => 50000,
            'fare_per_kg' => 10000,
            'expected_arrival_day' => 2,
        ],
        [
            'name' => 'Sea',
            'base_fare' => 15000,
            'fare_per_kg' => 2000,
            'expected_arrival_day' => 20,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Mode::insert($this->modes);
    }
}
