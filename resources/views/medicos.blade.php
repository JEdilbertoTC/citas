<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medicos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if($role->role == 'ROLE_ADMIN')
                        <button type="button" class="float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Agregar Medico
                        </button>
                    @endif
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Medico</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">X
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('/medicos')}}" method="post" name="medicos" id="medicos">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                Nombre
                                                <input type="text" placeholder="Nombre" name="nombre"
                                                       class="form-control">
                                            </div>
                                            <div class="col-12">
                                                Apellido Paterno
                                                <input type="text" placeholder="Apellido Paterno" name="apellido1"
                                                       class="form-control">
                                            </div>
                                            <div class="col-12">
                                                Apellido Materno
                                                <input type="text" placeholder="Apellido Materno" name="apellido2"
                                                       class="form-control">
                                            </div>
                                            <div class="col-12">
                                                Especialidad
                                                <input type="text" placeholder="Especialidad" name="especialidad"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <button type="submit" class="float-end mt-3">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Especialidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($medicos as $medico)
                            <tr>
                                <td>{{$medico->nombre}}</td>
                                <td>{{$medico->apellido_paterno}}</td>
                                <td>{{$medico->apellido_materno}}</td>
                                <td>{{$medico->especialidad}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('medicos').addEventListener('submit', (e) => {
                const nombre = document.forms["medicos"]["nombre"].value
                const apellidoPaterno = document.forms["medicos"]["apellido1"].value
                const apellidoMaterno = document.forms["medicos"]["apellido2"].value
                const especialidad = document.forms["medicos"]["especialidad"].value

                if (!nombre || !apellidoPaterno || !apellidoMaterno || !especialidad) {
                    swal({
                        title: "Rellene todos los campos",
                        icon: "error",
                        dangerMode: true,
                    })
                    e.preventDefault()
                } else {
                    e.preventDefault()
                    swal({
                        title: "Medico registrado correctamente",
                        icon: "success",
                        dangerMode: true,
                    }).then(() => {
                        document.getElementById('medicos').submit()
                    })
                }

            })

        })
    </script>
</x-app-layout>
