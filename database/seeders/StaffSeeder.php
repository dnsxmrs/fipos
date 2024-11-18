<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staffs')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone_number' => '1234567890',
                'address' => '123 Main Street',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone_number' => '0987654321',
                'address' => '456 Elm Avenue',
            ],
            [
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'email' => 'alice.johnson@example.com',
                'phone_number' => '5555555555',
                'address' => '789 Oak Lane',
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Brown',
                'email' => 'bob.brown@example.com',
                'phone_number' => '1112223333',
                'address' => '321 Pine Drive',
            ],
            [
                'first_name' => 'Charlie',
                'last_name' => 'Davis',
                'email' => 'charlie.davis@example.com',
                'phone_number' => '4443332222',
                'address' => '654 Cedar Road',
            ],
        ]);
    }
}
