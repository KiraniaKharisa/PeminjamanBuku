<?php

namespace App\Models;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $guarded = ['id_kategori'];
    
    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id', 'id_kategori');
    }
}
