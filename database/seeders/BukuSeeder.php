<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'id_buku' => 1,
                'kode_buku' => 'BK001',
                'judul_buku' => 'With J',
                'penulis' => 'Fahmy',
                'penerbit' => 'Tech Press',
                'tanggal_terbit' => '2023-01-01',
                'kategori_id' => 2,
                'stok' => 10,
                'created_at' => now(),
                'updated_at' => now(),
                'sampul' => '1.jpeg',
                'deskripsi' => 'Novel romantis yang mengisahkan perjalanan cinta dan tantangan hidup.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ab veritatis molestiae perspiciatis atque ea alias cupiditate provident dolore commodi reiciendis ut ad maxime at delectus vel recusandae magnam harum nam mollitia similique accusamus, est rem temporibus. Consequatur, quo nisi minima, nulla neque magnam commodi magni tempora provident harum vel aliquid ex fugit dicta! Porro, voluptates maiores? Exercitationem eum veritatis esse recusandae, dolorem laborum fugiat! Harum, velit. Commodi at explicabo impedit ut libero repudiandae ratione nam reiciendis, facere iure, doloremque harum vel nulla quam ea asperiores provident quibusdam nostrum soluta nisi saepe. Ex placeat odio non, neque amet accusamus nisi.'
            ],
        ]);
    }
}
