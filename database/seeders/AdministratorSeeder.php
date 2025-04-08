<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrator::firstOrCreate([
            'email' => "john.doe@example.com",
        ], [
            'name' => "John Doe",
            'password' => Hash::make('password'),
        ]);

        Administrator::factory()->count(5)->create();
    }
}
