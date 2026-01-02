<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarModel;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarModel::insert([
            [
                'id' => 1,
                'name' => 'Compass',
                'division_id' => 10,
                'specialist_id' => null,
            ],
            [
                'id' => 2,
                'name' => 'Wrangler',
                'division_id' => 10,
                'specialist_id' => null,
            ],
            [
                'id' => 3,
                'name' => 'Escape',
                'division_id' => 6,
                'specialist_id' => 3,
            ],
            [
                'id' => 4,
                'name' => 'CPO Bentely',
                'division_id' => 4,
                'specialist_id' => 5,
            ],
            [
                'id' => 5,
                'name' => 'Expedition',
                'division_id' => 6,
                'specialist_id' => 4,
            ],
        ]);
    }
}
