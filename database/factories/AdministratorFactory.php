<?php

namespace Database\Factories;

use App\Models\Administrator;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministratorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Administrator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->optional(0.1)->title,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->optional(0.1)->suffix,
            'email' => $this->faker->unique()->freeEmail,
            'phone' => $this->faker->unique()->numberBetween(1111111111, 9999999999),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => UserRoleEnum::ADMINISTRATOR,
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip' => Str::substr($this->faker->postcode, 0, 5),
        ];
    }
}
