<?php

namespace Database\Factories;

use App\Models\FundManager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fund>
 */
class FundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fund_manager_id' => FundManager::factory(),
            'name' => fake()->company(),
            'start_year' => fake()->year(),
        ];
    }
}
