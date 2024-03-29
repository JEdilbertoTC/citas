<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaMedica extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'medico_id'
    ];

    protected $table = 'areas_medicas';
}
