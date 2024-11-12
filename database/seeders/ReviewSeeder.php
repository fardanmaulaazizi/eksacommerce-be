<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            'user_id' => 1,
            'product_id' => 1,
            'comment' => 'Produk yang sangat bagus, saya pakai sehari-hari',
        ]);
        DB::table('reviews')->insert([
            'user_id' => 2,
            'product_id' => 1,
            'comment' => 'kurang d',
        ]);
        DB::table('reviews')->insert([
            'user_id' => rand(1, 3),
            'product_id' => rand(1, 5),
            'comment' => Str::random(10),
        ]);
        DB::table('reviews')->insert([
            'user_id' => rand(1, 3),
            'product_id' => rand(1, 5),
            'comment' => Str::random(10),
        ]);
        DB::table('reviews')->insert([
            'user_id' => rand(1, 3),
            'product_id' => rand(1, 5),
            'comment' => Str::random(10),
        ]);
        DB::table('reviews')->insert([
            'user_id' => rand(1, 3),
            'product_id' => rand(1, 5),
            'comment' => Str::random(10),
        ]);
        DB::table('reviews')->insert([
            'user_id' => rand(1, 3),
            'product_id' => rand(1, 5),
            'comment' => Str::random(10),
        ]);
        DB::table('reviews')->insert([
            'user_id' => rand(1, 3),
            'product_id' => rand(1, 5),
            'comment' => Str::random(10),
        ]);
        DB::table('reviews')->insert([
            'user_id' => rand(1, 3),
            'product_id' => rand(1, 5),
            'comment' => Str::random(10),
        ]);
    }
}
