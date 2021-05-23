<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Country;

class CountryTest extends TestCase
{
    public function test_can_list_countries() {

        $countries = factory(Country::class, 2)->create()->map(function ($post) {
            return $post->only(['id', 'name', 'code', 'flat_rate']);
        });

        $this->get(route('countries.index'))
            ->assertStatus(200);
    }

    public function test_can_create_country() {

        $data = [
            'name' => $this->faker->country(),
            'code' => $this->faker->countryCode(),
            'flat_rate' => $this->faker->numberBetween(10000, 20000),
        ];

        $this->from('countries')->post(route('countries.store'), $data)
            ->assertRedirect('countries')
            ->assertSessionHas('success')
            ->assertStatus(302);

    }

    public function test_can_update_country() {

        $country = factory(Country::class)->create();

        $data = [
            'name' => $this->faker->country(),
            'code' => $this->faker->countryCode(),
            'flat_rate' => $this->faker->numberBetween(10000, 20000),
        ];

        $this->from('countries')->put(route('countries.update', $country->id), $data)
            ->assertRedirect('countries')
            ->assertSessionHas('success')
            ->assertStatus(302);

    }

    public function test_a_country_requires_a_name() {

        $attributes = factory(Country::class)->raw(['name' => '']);

        $this->post(route('countries.store'), $attributes)
            ->assertSessionHasErrors('name')
            ->assertStatus(302);
    }

    public function test_can_delete_country() {

        $country = factory(Country::class)->create();

        $this->from('countries')->delete(route('countries.destroy', $country->id))
            ->assertRedirect('countries')
            ->assertSessionHas('success')
            ->assertStatus(302);
    }
}
