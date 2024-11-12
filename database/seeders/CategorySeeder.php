<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'electronics',
        ]);
        DB::table('categories')->insert([
            'name' => 'clothing',
        ]);
        DB::table('categories')->insert([
            'name' => 'tools',
        ]);
        DB::table('categories')->insert([
            'name' => 'vehicles',
        ]);
        DB::table('categories')->insert([
            'name' => 'books',
        ]);
        DB::table('categories')->insert([
            'name' => 'food',
        ]);
    }
}
