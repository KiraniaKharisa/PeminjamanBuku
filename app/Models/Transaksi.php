<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $guarded = ['id_transaksi'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id_buku');
    }

    public function getStatusLabelAttribute() {
        if($this->status == 1 && Carbon::parse($this->tanggal_kembali)->lt(Carbon::today())) {
            return 'Terlambat';
        }

       return match($this->status) {
        '0' => 'Ditunda',
        '1' => 'Dipinjam',
        '2' => 'Dikembalikan',
        '3' => 'Ditolak',
        default => 'Tidak DIketahui'
       };
    }

    public function getPinjamanSaatIniAttribute() {
        return $this->total_pinjam - $this->jumlah_dikembalikan;
    }

    
}
