<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'ville_id'           => Ville::inRandomOrder()->value('id') ?? Ville::factory(),
            'nom'                => fake()->lastName(),
            'prenom'             => fake()->firstName(),
            'email'              => fake()->unique()->safeEmail(),
            'telephone'          => fake()->unique()->numerify('+229 01 ## ## ## ##'),
            'photo'              => null,
            'status'             => 'active',
            'role'               => UserRole::USER,
            'email_verified_at'  => now(),
            'password'           => static::$password ??= Hash::make('aaaaaaaa'),
            'remember_token'     => null,
        ];
    }

    public function student(): static
    {
        return $this->state(['role' => UserRole::USER]);
    }

    public function diaspora(): static
    {
        return $this->state(['role' => UserRole::DIASPORA]);
    }

    public function admin(): static
    {
        return $this->state(['role' => UserRole::ADMIN]);
    }

    public function unverified(): static
    {
        return $this->state(['email_verified_at' => null]);
    }

    public function inactive(): static
    {
        return $this->state(['status' => 'inactive']);
    }
}
