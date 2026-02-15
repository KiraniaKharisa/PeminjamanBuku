<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class BukuExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    public function collection()
    {
        return Buku::with('kategori')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Buku',
            'Judul Buku',
            'Penulis',
            'Penerbit',
            'Tanggal Terbit',
            'Stok',
            'Kategori',
            'Deskripsi'
        ];
    }

    public function map($buku): array
    {
        return [
            $buku->kode_buku,
            $buku->judul_buku,
            $buku->penulis,
            $buku->penerbit,
            $buku->tanggal_terbit,
            $buku->stok,
            $buku->kategori?->nama_kategori,
            $buku->deskripsi,
        ];
    }
}
