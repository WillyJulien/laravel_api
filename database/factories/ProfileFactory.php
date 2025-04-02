<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Enums\ProfileStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
* @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
*/

class ProfileFactory extends Factory
{
    /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */

    // Indicates model
    protected $model = Profile::class;

    public function definition(): array
    {

        // Using faker to nest the Profile table
        return [
            'name' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'status' => $this->faker->randomElement([
        // Call the randomElement method to randomly select a value from an array. We pass it the ProfileStatus class, which returns an array
                ProfileStatus::Active->value,
                ProfileStatus::Inactive->value,
                ProfileStatus::Pending->value,
            ]),
        ];
    }
}
