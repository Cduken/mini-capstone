<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // if (!User::where('email', 'admin@gmail.com')->exists()) {
        //     User::create([
        //         'name' => 'Admin',
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make('admin123'),
        //         'userType' => 'admin'
        //     ]);
        // }
    }
}
