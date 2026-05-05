<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'username' => 'admin',
            'password' => Hash::make('123'),
            'nama_admin' => 'Admin',
            'id_level' => 1
            ],
            [
            'username' => 'petugas',
            'password' => Hash::make('123'),
            'nama_admin' => 'Petugas',
            'id_level' => 2
            ]
        ]);
    }
}
