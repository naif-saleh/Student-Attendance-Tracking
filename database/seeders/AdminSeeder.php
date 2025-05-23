<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     'role' => 'admin',
        //     'password' => Hash::make('123456789')
        // ]);
        User::create([
            'name' => 'Admin',
            'email' => 'naif.ecolor@gmail.com', 
            'role' => 'admin',
            'password' => Hash::make('775977963Ecolor$')
        ]);
    }
}
