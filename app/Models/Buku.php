<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    public $guarded = ['id_buku'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    public function userFavorit(){
        return $this->belongsToMany(User::class, 'buku_favorit', 'buku_id', 'user_id');
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class, 'buku_id', 'id_buku');
    }
}
