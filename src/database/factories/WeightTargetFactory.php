<?php

namespace Database\Factories;

use App\Models\WeightTarget;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'target_weight' => $this->faker->randomFloat(2, 40, 100),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
