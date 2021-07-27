<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserDomicilio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-70 years', '-18 years')
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->domicilio()->save(new UserDomicilio([
                'domicilio' => $this->faker->address(),
                'numero_exterior' => $this->faker->buildingNumber(),
                'colonia' => $this->faker->streetName(),
                'cp' => $this->faker->biasedNumberBetween(11111,99999),
                'ciudad' => $this->faker->city()
            ]));
        });
    }
}
