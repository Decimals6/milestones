<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            ['transaction_id' => 1, 'amount_paid' => 150000, 'payment_method' => 'bank_transfer'],
            ['transaction_id' => 2, 'amount_paid' => 75000, 'payment_method' => 'cash'],
        ]); 
    }
}
