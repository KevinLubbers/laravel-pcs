<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::create([
            'id' => 1,
            'name' => 'Audi',
            'specialist_id' => 5,
        ]);
        Division::create([
            'id' => 2,
            'name' => 'Chevrolet',
            'specialist_id' => 5,
        ]);
        Division::create([
            'id' => 3,
            'name' => 'Chrysler',
            'specialist_id' => 6,
        ]);
        Division::create([
            'id' => 4,
            'name' => 'CPO',
            'specialist_id' => 4,
        ]);
        Division::create([
            'id' => 5,
            'name' => 'Dodge',
            'specialist_id' => 0,
        ]);
        Division::create([
            'id' => 6,
            'name' => 'Ford',
            'specialist_id' => 0,
        ]);
        Division::create([
            'id' => 7,
            'name' => 'Harley-Davidson',
            'specialist_id' => 4,
        ]);
        Division::create([
            'id' => 8,
            'name' => 'Honda',
            'specialist_id' => 0,
        ]);
        Division::create([
            'id' => 9,
            'name' => 'Infiniti',
            'specialist_id' => 0,
        ]);
        Division::create([
            'id' => 10,
            'name' => 'Jeep',
            'specialist_id' => 4,
        ]);
        Division::create([
            'id' => 11,
            'name' => 'Lexus',
            'specialist_id' => 0,
        ]);
        Division::create([
            'id' => 12,
            'name' => 'Lincoln',
            'specialist_id' => 6,
        ]);
        Division::create([
            'id' => 13,
            'name' => 'Nissan',
            'specialist_id' => 0,
        ]);
        Division::create([
            'id' => 14,
            'name' => 'Ram Trucks',
            'specialist_id' => 3,
        ]);
        Division::create([
            'id' => 15,
            'name' => 'Toyota',
            'specialist_id' => 0,
        ]);
    }
}
