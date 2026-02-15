<?php

namespace App\Exports;

use App\Models\Kunjungan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KunjunganExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Kunjungan::with('user')->get()->map(function ($item) {
            return [
                'nama'    => $item->user->nama,
                'tanggal' => $item->tanggal,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Pengunjung',
            'Tanggal Kunjungan'
        ];
    }
}
