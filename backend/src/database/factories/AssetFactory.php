<?php
namespace Database\Factories;
/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name'   => fake()->company(),
            'current_price' => fake()->numberBetween(0, 200),
        ];

    }

}
