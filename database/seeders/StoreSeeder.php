<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insert([
            'name' => 'fardan electronics',
            'location' => 'Tegal, Indonesia',
            'user_id' => 1,
            'status' => 'active'
        ]);
        DB::table('stores')->insert([
            'name' => 'maula shop',
            'location' => 'Tegal, Indonesia',
            'user_id' => 2,
            'status' => 'active'
        ]);
        DB::table('stores')->insert([
            'name' => 'aziscript',
            'location' => 'Tegal, Indonesia',
            'user_id' => 3,
            'status' => 'active'
        ]);
    }
}
