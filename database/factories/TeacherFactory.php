<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'title' => $this->faker->optional(0.1)->title,
            'email' => $this->faker->unique()->freeEmail,
            'school_email' => $this->faker->unique()->freeEmail,
            'phone' => Str::limit($this->faker->unique()->phoneNumber, 10),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => UserRoleEnum::TEACHER,
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => Str::limit($this->faker->postcode, 5),
        ];
    }
}
