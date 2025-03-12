<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            ['name' => 'John Doe', 'email' => 'john@example.com', 'phone_number' => '081234567890'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone_number' => '082345678901'],
        ]);
    }
}
