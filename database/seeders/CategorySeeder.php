<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sedan',
                'description' => 'Four-door passenger cars with separate trunk compartments'
            ],
            [
                'name' => 'SUV',
                'description' => 'Sport Utility Vehicles with higher ground clearance and off-road capability'
            ],
            [
                'name' => 'Luxury Vehicle',
                'description' => 'Premium cars with high-end features and amenities'
            ],
            [
                'name' => 'Electric Vehicle (EV)',
                'description' => 'Cars powered entirely by electric motors'
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
