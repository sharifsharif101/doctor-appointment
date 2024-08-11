<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['department' => 'Medical - Dentist'],
            ['department' => 'Medical - Pediatrics'],
            ['department' => 'Medical - Cardiology'],
            ['department' => 'Medical - Neurology'],
            ['department' => 'Medical - Orthopedics'],
            ['department' => 'Medical - Gynecology'],
            ['department' => 'Medical - Dermatology'],
            ['department' => 'Medical - Radiology'],
            ['department' => 'Medical - Psychiatry'],
            ['department' => 'Medical - Oncology'],
            ['department' => 'Medical - Emergency Medicine'],
            ['department' => 'Medical - General Surgery'],
            ['department' => 'Medical - Ophthalmology'],
            ['department' => 'Medical - Urology'],
            ['department' => 'Medical - Anesthesiology']
        ]);
    }
}
