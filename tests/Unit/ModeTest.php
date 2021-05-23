<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Mode;

class ModeTest extends TestCase
{
    public function test_can_list_modes() {

        $modes = factory(Mode::class, 2)->create()->map(function ($post) {
            return $post->only(['id', 'name', 'base_fare', 'fare_per_kg', 'expected_arrival_day']);
        });

        $this->get(route('modes.index'))
            ->assertStatus(200);
    }

    public function test_can_create_mode() {

        $data = [
            'name' => $this->faker->word(),
            'base_fare' => $this->faker->numberBetween(10000, 90000),
            'fare_per_kg' => $this->faker->numberBetween(1000, 9000),
            'expected_arrival_day' => $this->faker->numberBetween(1, 50),
        ];

        $this->from('modes')->post(route('modes.store'), $data)
            ->assertRedirect('modes')
            ->assertSessionHas('success')
            ->assertStatus(302);

    }

    public function test_can_update_mode() {

        $mode = factory(Mode::class)->create();

        $data = [
            'name' => $this->faker->word(),
            'base_fare' => $this->faker->numberBetween(10000, 90000),
            'fare_per_kg' => $this->faker->numberBetween(1000, 9000),
            'expected_arrival_day' => $this->faker->numberBetween(1, 50),
        ];

        $this->from('modes')->put(route('modes.update', $mode->id), $data)
            ->assertRedirect('modes')
            ->assertSessionHas('success')
            ->assertStatus(302);

    }

    public function test_a_mode_requires_all_fields() {

        $attributes = factory(Mode::class)->raw([
            'name' => '',
            'base_fare' => '',
            'fare_per_kg' => '',
            'expected_arrival_day' => '',
        ]);

        $this->post(route('modes.store'), $attributes)
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('base_fare')
            ->assertSessionHasErrors('fare_per_kg')
            ->assertSessionHasErrors('expected_arrival_day')
            ->assertStatus(302);
    }

    public function test_can_delete_mode() {

        $mode = factory(Mode::class)->create();

        $this->from('modes')->delete(route('modes.destroy', $mode->id))
            ->assertRedirect('modes')
            ->assertSessionHas('success')
            ->assertStatus(302);
    }
}
