<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */

    public function run(): void
    {
        // Generates 20 profiles using the Profile factory and saves them to the database
        Profile::factory()->count(20)->create();
    }
}
