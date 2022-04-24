<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Areas Medicas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if($role->role == 'ROLE_ADMIN')
                        <button type="button" class="float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Agregar Area Medica
                        </button>
                    @endif

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Area Medica</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">X
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('/areas')}}" method="post" name="areas" id="areas">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                Area
                                                <input type="text" placeholder="Area" name="nombre" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                Medico responsable
                                                <select name="medico_id" class="form-control">
                                                    @foreach($medicos as $medico)
                                                        <option name="medico_id" class="form-control"
                                                                value="{{$medico->id}}">
                                                            {{$medico->nombre}} {{$medico->apellido_paterno}} {{$medico->apellido_materno}}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                            <th scope="col">Area</th>
                            <th scope="col">Medico</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td>{{$area->nombre}}</td>
                                <td>{{$area->medico->nombre}} {{$area->medico->apellido_paterno}} {{$area->medico->apellido_materno}}</td>
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
            document.getElementById('areas').addEventListener('submit', (e) => {
                const nombre = document.forms["areas"]["nombre"].value
                const medicoId = document.forms["areas"]["medico_id"].value

                if (!nombre || !medicoId) {
                    swal({
                        title: "Rellene todos los campos",
                        icon: "error",
                        dangerMode: true,
                    })
                    e.preventDefault()
                } else {
                    e.preventDefault()
                    swal({
                        title: "Area medica registrada correctamente",
                        icon: "success",
                        dangerMode: true,
                    }).then(() => {
                        document.getElementById('areas').submit()
                    })
                }

            })

        })
    </script>
</x-app-layout>
