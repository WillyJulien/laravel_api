<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Administrator::create([
            'name' => "John Doe",
            'email' => "john.doe@example.com",
            'password' => Hash::make('password'),
        ]);

        Administrator::factory()->count(5)->create();
    }
}
