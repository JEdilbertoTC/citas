<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if($role->role == 'ROLE_ADMIN')
                        <button type="button" class="float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Agregar pacientes
                        </button>
                    @endif

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">X</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('/pacientes')}}" method="post" name="pacientes" id="pacientes">
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pacientes as $paciente)
                            <tr>
                                <td>{{$paciente->nombre}}</td>
                                <td>{{$paciente->apellido_paterno}}</td>
                                <td>{{$paciente->apellido_materno}}</td>
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
            document.getElementById('pacientes').addEventListener('submit', (e) => {
                const nombre = document.forms["pacientes"]["nombre"].value
                const apellidoPaterno = document.forms["pacientes"]["apellido1"].value
                const apellidoMaterno = document.forms["pacientes"]["apellido2"].value

                if (!nombre || !apellidoPaterno || !apellidoMaterno) {
                    swal({
                        title: "Rellene todos los campos",
                        icon: "error",
                        dangerMode: true,
                    })
                    e.preventDefault()
                } else {
                    e.preventDefault()
                    swal({
                        title: "Paciente registrado correctamente",
                        icon: "success",
                        dangerMode: true,
                    }).then(() => {
                        document.getElementById('pacientes').submit()
                    })
                }

            })

        })
    </script>
</x-app-layout>
