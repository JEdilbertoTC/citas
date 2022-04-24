<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'descripcion',
        'medico_id'
    ];

    protected $table = 'citas';
}
