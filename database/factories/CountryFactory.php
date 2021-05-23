<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $this->faker->country(),
        'code' => $this->faker->countryCode(),
        'flat_rate' => $this->faker->numberBetween(10000, 90000),
    ];
});
