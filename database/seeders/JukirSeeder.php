<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JukirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create user with specific data
        \App\Models\Jukir::create([
            'name' => 'Test Jukir',
            'nik' => '1234567890',
            'dob' => '1990-01-01',
            'address' => 'Jl. Test No. 1',
            'phone' => '081234567890',
            'religion' => 'islam',
            'gender' => 'pria',
            'photo' => 'jukir.jpg',
        ]);
    }
}
