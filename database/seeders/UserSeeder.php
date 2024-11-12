<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
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
        DB::table('users')->insert([
            'name' => 'fardan',
            'email' => 'fardan@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]); 
        DB::table('users')->insert([
            'name' => 'maula',
            'email' => 'maula@mail.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);
        DB::table('users')->insert([
            'name' => 'azizi',
            'email' => 'azizi@mail.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]); 
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
