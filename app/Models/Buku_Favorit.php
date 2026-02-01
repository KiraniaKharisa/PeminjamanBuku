<?php

namespace App\Models;

use App\Models\Buku;
use App\Models\User; 
use Illuminate\Database\Eloquent\Model;

class Buku_Favorit extends Model
{
    public $table = 'buku_favorit';
    protected $primaryKey = 'id_favorit';
    protected $guarded = ['id_favorit'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id_buku');
    }
}
