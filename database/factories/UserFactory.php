<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // or Hash::make('password')
            'role_id' => 3, // default to patient
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'department' => null, // default to null
            'image' => null,
            'education' => $this->faker->words(5, true), // 5 words
            'description' => $this->faker->words(5, true), // 5 words
            'gender' => $this->faker->randomElement(['male', 'female']),
        ];
    }

    public function doctor()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 1,
                'department' => $this->faker->randomElement(['Cardiology', 'Neurology', 'Orthopedics']),
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 2,
                'department' => null,
            ];
        });
    }

    public function patient()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 3,
                'department' => null,
            ];
        });
    }
    public function specificAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin@admin.com'),
                'role_id' => 2,
                'address' => '123 Admin St',
                'phone_number' => '123-456-7890',
                'department' => null,
                'image' => null,
                'education' => 'Admin Degree',
                'description' => 'Admin Description',
                'gender' => 'male',
            ];
        });
    }

   
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
