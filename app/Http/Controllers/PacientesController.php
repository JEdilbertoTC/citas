<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    public function show()
    {
        return view('pacientes', [
            'pacientes' => Paciente::all(),
            'role' => DB::table('roles_por_usuario')->where([['user_id', '=', auth()->id()]])->first()
        ]);
    }

    public function guardar()
    {
        Paciente::create([
            'nombre' => request('nombre'),
            'apellido_paterno' => request('apellido1'),
            'apellido_materno' => request('apellido2'),
        ]);

        return redirect('pacientes');
    }
}
