<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id_role';
    public $guarded = ['id_role'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id_role');
    }
}
