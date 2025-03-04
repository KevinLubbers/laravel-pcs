<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Dan Egglinger',
            'email' => 'deggling@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 2,
            'name' => 'Menaga LaCroce',
            'email' => 'mlacroce@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 3,
            'name' => 'John Ippolito',
            'email' => 'jippol@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 4,
            'name' => 'Kevin Lubbers',
            'email' => 'klubber@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 5,
            'name' => 'Daniel Veliz',
            'email' => 'dveliz@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 6,
            'name' => 'Eric Robinson',
            'email' => 'erobinson@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 7,
            'name' => 'Todd Favor',
            'email' => 'tfavor@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 8,
            'name' => 'PCS Group',
            'email' => 'pcsgroup@militarycars.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'id' => 9,
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
