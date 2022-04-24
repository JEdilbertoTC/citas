<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{

    public function show()
    {
        return view('citas', [
            'role' => DB::table('roles_por_usuario')->where([['user_id', '=', auth()->id()]])->first(),
            'pacientes' => Paciente::all(),
            'medicos' => Medico::all()
        ]);
    }

    public function guardar()
    {
        Cita::create([
            'title' => request('title'),
            'start' => request('day') . "T" . request('start'),
            'descripcion' => request('descripcion'),
            'medico_id' => request('medico_id')
        ]);

        return redirect('citas');
    }

    public function getCitas()
    {
        return Cita::all();
    }

    public function modificar()
    {
        $cita = Cita::where('id', '=', request('id'))->first();

        $cita->title = request('title');
        $cita->descripcion = request('descripcion');
        $cita->aceptada = request('aceptada') == 'on';
        $cita->start = request('day') . "T" . request('start');
        $cita->medico_id = request('medico_id');

        $cita->save();

        return redirect('citas');
    }

    public function eliminar()
    {
        Cita::find(request('id'))->delete();
        return redirect('citas');
    }
}
