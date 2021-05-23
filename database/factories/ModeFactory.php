<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mode;
use Faker\Generator as Faker;

$factory->define(Mode::class, function (Faker $faker) {
    return [
        'name' => $this->faker->word(),
        'base_fare' => $this->faker->numberBetween(10000, 90000),
        'fare_per_kg' => $this->faker->numberBetween(1000, 9000),
        'expected_arrival_day' => $this->faker->numberBetween(1, 50),
    ];
});
