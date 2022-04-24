<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesPorUsuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role'
    ];

    protected $table = 'roles_por_usuario';

}
