<?php

namespace Database\Factories;

use App\Enum\OrganizationStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'code' => strtoupper(Str::random(6)),
            'owner_id' => User::all()->random()->id,
            'status' => fake()->randomElement(OrganizationStatusEnum::cases()),
        ];
    }
}
