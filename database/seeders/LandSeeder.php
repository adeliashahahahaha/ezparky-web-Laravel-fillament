<?php

namespace Database\Seeders;

use App\Models\Land;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Land::create([
            'name' => 'Test Land',
            'nik' => '1234567890',
            'dob' => '1990-01-01',
            'type' => 'private',
            'land_status' => 'property_right',
            'photo' => 'land.jpg',
            'address' => 'Malang Jalan jalan',
            'phone' => '081234567890',
            'size' => 100,
            'latitude' => '-6.200000',
            'longitude' => '106.816666',
        ]);

        Land::create([
            'name' => 'Test Land 2',
            'nik' => '1234567890',
            'dob' => '1990-01-01',
            'type' => 'private',
            'land_status' => 'property_right',
            'photo' => 'land.jpg',
            'address' => 'Malang Jalan jalan',
            'phone' => '081234567890',
            'size' => 100,
            'latitude' => '0',
            'longitude' => '0',
        ]);
    }
}
