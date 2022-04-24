<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Support\Facades\DB;

class MedicosController extends Controller
{
    public function show()
    {
        return view('medicos', [
            'medicos' => Medico::all(),
            'role' => DB::table('roles_por_usuario')->where([['user_id', '=', auth()->id()]])->first()
        ]);
    }

    public function guardar()
    {
        Medico::create([
            'nombre' => request('nombre'),
            'apellido_paterno' => request('apellido1'),
            'apellido_materno' => request('apellido2'),
            'especialidad' => request('especialidad'),
        ]);

        return redirect('medicos');
    }

    public function getMedico($id)
    {
        return Medico::where([['id', '=', $id]])->first();
    }
}
