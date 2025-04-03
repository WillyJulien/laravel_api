<?php

namespace Database\Factories;

use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash; // Ajoute l'importation de Hash si nécessaire

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrator>
 */
class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // On génère directement le mot de passe haché ici
        ];
    }

}
