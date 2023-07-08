<?php

namespace Database\Factories;

use App\Enums\TicketCategory;
use Illuminate\Support\Arr;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'ticket_category_id' => Arr::random(TicketCategory::cases()),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
