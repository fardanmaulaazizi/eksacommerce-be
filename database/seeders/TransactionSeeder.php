<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('transactions')->insert([
            'order_id' => 'order112',
            'user_id' => 2,
            'product_id' => 1,
            'quantity' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'pending',
            'shipping_address' => 'Tegal, Indonesia',
        ]);
        DB::table('transactions')->insert([
            'order_id' => 'order112',
            'user_id' => 2,
            'product_id' => 2,
            'quantity' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'pending',
            'shipping_address' => 'Tegal, Indonesia',
        ]);
        DB::table('transactions')->insert([
            'order_id' => 'order113',
            'user_id' => 3,
            'product_id' => 2,
            'quantity' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'already paid',
            'shipping_address' => 'Tegal, Indonesia',
        ]);
        DB::table('transactions')->insert([
            'order_id' => 'order114',
            'user_id' => 2,
            'product_id' => 1,
            'quantity' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'already paid',
            'shipping_address' => 'Tegal, Indonesia',
        ]);
    }
}
