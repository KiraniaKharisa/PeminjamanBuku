<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'id_transaksi' => 1,
                'user_id' => 1,
                'buku_id' => 1,
                'total_pinjam' => 1,
                'tanggal_pinjam' => now()->subDays(3),
                'tanggal_kembali' => now()->addDays(4),
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
