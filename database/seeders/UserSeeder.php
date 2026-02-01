<?php

namespace Database\Seeders;

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
        DB::table('user')->insert([
            [
                'id_user' => 1,
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'profil' => '1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
