<?php

namespace App\Http\Controllers;

use App\Models\AreaMedica;
use App\Models\Medico;
use Illuminate\Support\Facades\DB;

class AreasMedicasController extends Controller
{
    public function show()
    {
        $areas = AreaMedica::all();

        foreach ($areas as $area) {
            $area['medico'] = Medico::where([['id', '=', $area->medico_id]])->first();
            unset($area['medico_id']);
        }

        return view('areas', [
            'areas' => $areas,
            'role' => DB::table('roles_por_usuario')->where([['user_id', '=', auth()->id()]])->first(),
            'medicos' => Medico::all()
        ]);
    }

    public function guardar()
    {

        AreaMedica::create([
            'nombre' => request('nombre'),
            'medico_id' => request('medico_id')
        ]);

        return redirect('areas');
    }

}
