<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Tomasa',
            'last_name' => 'Kunde',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminpassword123'), // use a secure password
            'role' => 'admin',
            'status' => true,
            'remember_token' => Str::random(10),
        ]);
    }
}