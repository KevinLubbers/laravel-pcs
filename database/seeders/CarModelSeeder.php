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
                'name' => 'Expedition',
                'division_id' => 6,
                'specialist_id' => 4,
            ],
            [
                'id' => 5,
                'name' => 'A6 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 6,
                'name' => 'Q7 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 7,
                'name' => 'SQ7 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 8,
                'name' => 'A3 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 9,
                'name' => 'Q8 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 10,
                'name' => 'RS Q8 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 11,
                'name' => 'SQ8 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 12,
                'name' => 'RS 3 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 13,
                'name' => 'S3 Quattro',
                'division_id' => 1,
                'specialist_id' => null,
            ],
            [
                'id' => 14,
                'name' => 'Jetta',
                'division_id' => 16,
                'specialist_id' => null,
            ],
            [
                'id' => 15,
                'name' => 'Taos',
                'division_id' => 16,
                'specialist_id' => null,
            ],
            [
                'id' => 16,
                'name' => 'Golf',
                'division_id' => 16,
                'specialist_id' => null,
            ],
            [
                'id' => 17,
                'name' => 'Tiguan',
                'division_id' => 16,
                'specialist_id' => null,
            ],
            [
                'id' => 18,
                'name' => 'Pacifica',
                'division_id' => 3,
                'specialist_id' => null,
            ],
            [
                'id' => 19,
                'name' => 'Pacifica Hybrid',
                'division_id' => 3,
                'specialist_id' => null,
            ],
            [
                'id' => 20,
                'name' => 'Voyage',
                'division_id' => 3,
                'specialist_id' => null,
            ]
        ]);
    }
}
