<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\AdminUserFactory;


use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        User::factory()->admin()->count(2)->create();
        // Create 3 Doctors
        User::factory()->doctor()->count(3)->create();
        // Create 4 Patients
        User::factory()->patient()->count(4)->create();
        User::factory()->specificAdmin()->create();
    }
}
