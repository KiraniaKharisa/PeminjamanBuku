<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuFavoritSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku_favorit')->insert([
            [
                'id_favorit' => 1,
                'user_id' => 1,
                'buku_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
