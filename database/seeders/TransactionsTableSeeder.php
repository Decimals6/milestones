<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            ['customer_id' => 1, 'total_amount' => 150000, 'status' => 'completed'],
            ['customer_id' => 2, 'total_amount' => 75000, 'status' => 'pending'],
        ]);
    }
}
