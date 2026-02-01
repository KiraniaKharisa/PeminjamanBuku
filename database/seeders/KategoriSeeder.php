<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'id_kategori' => 1,
                'nama_kategori' => 'Novel', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2, 
                'nama_kategori' => 'Teknologi', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 3, 
                'nama_kategori' => 'Sejarah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 4, 
                'nama_kategori' => 'Edukasi',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
