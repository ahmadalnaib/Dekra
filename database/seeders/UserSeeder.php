<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('users')->truncate();
          User::create([
            'name' => 'Admin',
            'email' => 'admin@dekra.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'role' => 'admin',
        ]);

    }
}
