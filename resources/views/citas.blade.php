<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consultorio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div id='calendar'></div>
                    </div>

                    <div class="modal" tabindex="-1" id="modal-crear">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">X
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="cita1" method="post" action="{{url('/citas')}}" name="citas1">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                Paciente:
                                                <select name="title" id="" class="input-group">
                                                    @foreach($pacientes as $paciente)
                                                        <option
                                                            value="{{$paciente->nombre}} {{$paciente->apellido_paterno}} {{$paciente->apellido_materno}}"
                                                            name="title">
                                                            {{$paciente->nombre}}
                                                            {{$paciente->apellido_paterno}}
                                                            {{$paciente->apellido_materno}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                Hora:
                                                <input type="time" name="start" id="start1" class="form-control"
                                                       autocomplete="off">
                                            </div>
                                            <div class="col-12">
                                                Medico:
                                                <select name="medico_id" id="" class="input-group">
                                                    @foreach($medicos as $medico)
                                                        <option value="{{$medico->id}}" name="medico_id">
                                                            {{$medico->id}} {{$medico->nombre}} {{$medico->apellido_paterno}} {{$medico->apellido_materno}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                Escriba una breve descripción
                                                <textarea name="descripcion" id="descripcion1" autocomplete="off"
                                                          class="form-control"></textarea>
                                            </div>
                                            <input type="hidden" name="day" id="day1">
                                        </div>

                                        <button class="btn btn-success float-end mt-2" type="submit">Guardar</button>
                                    </form>


                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal" tabindex="-1" id="modal-mostrar">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="titulo"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">X
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="cita2" method="post" action="{{url('/citas')}}" name="citas2">
                                        @csrf @method('patch')
                                        <div class="row">
                                            <div class="col-12">
                                                Paciente
                                                <input type="text" name="title-disabled" id="title-disabled"
                                                       class="form-control"
                                                       autocomplete="off" disabled>

                                                <input type="hidden" name="title" id="title2" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                Hora:
                                                <input type="time" name="start" id="start2" class="form-control"
                                                       autocomplete="off">
                                            </div>
                                            <div class="col-12">
                                                Medico:
                                                <select name="medico_id" id="medico" class="input-group"></select>
                                            </div>
                                            <div class="col-12">
                                                Escriba una breve descripción
                                                <textarea name="descripcion" id="descripcion2" autocomplete="off"
                                                          class="form-control"></textarea>
                                            </div>
                                            <div class="col-12">
                                                Aceptada
                                                <input type="checkbox" name="aceptada" id="aceptada"
                                                       class="form-control">
                                            </div>
                                            <input type="hidden" name="day" id="day2">
                                            <input type="hidden" name="id">
                                        </div>

                                        <button class="btn btn-warning float-end mt-2" type="submit">Guardar</button>
                                    </form>

                                    <form action="{{url('/citas')}}" method="post" id="borrar" name="borrar">
                                        @csrf @method('delete')
                                        <input type="hidden" name="id">
                                        <button class="btn btn-danger float-end mt-2">Eliminar</button>
                                    </form>
                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar')

            const start = new Date().toISOString()

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',

                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek,timeGridFourDay',
                    end: 'today,prev,next'
                },

                validRange: {
                    start,
                },

                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'list'
                },

                views: {
                    timeGridFourDay: {
                        type: 'timeGrid',
                        duration: {days: 1},
                        buttonText: 'day',
                    },
                },

                events: "{{url('get-citas')}}",

                dateClick: function (info) {
                    const modal = new bootstrap.Modal(document.getElementById('modal-crear'), {})
                    modal.show()

                    document.querySelector('.modal-title').innerHTML = 'Fecha: ' + info.dateStr
                    document.querySelector('#day1').value = info.dateStr
                    document.querySelector('#start1').value = info.date.toString().split(' ')[4]

                    document.getElementById('cita1').addEventListener('submit', (e) => {

                        const title = document.forms["citas1"]["title"].value
                        const start = document.forms["citas1"]["start"].value
                        const descripcion = document.forms["citas1"]["descripcion"].value
                        const medico = document.forms["citas1"]["medico"].value

                        if (!title || !start || !descripcion || !medico) {
                            swal({
                                title: "Rellene todos los campos",
                                icon: "error",
                                dangerMode: true,
                            })
                            e.preventDefault()
                        } else {
                            e.preventDefault()
                            swal({
                                title: "Cita Agendada",
                                icon: "success",
                                dangerMode: true,
                            }).then(() => {
                                document.getElementById('cita1').submit()
                            })
                        }

                    })

                },

                eventClick: function (info) {
                    @if ($role->role != 'ROLE_ADMIN')
                        return
                    @endif

                    const modal = new bootstrap.Modal(document.getElementById('modal-mostrar'), {})
                    modal.show()

                    const date = new Date(info.event.start)

                    document.querySelector('#titulo').innerHTML = info.event.title
                    document.querySelector('#day2').value = info.event.startStr.split('T')[0]

                    const medicos = @json($medicos);

                    document.forms["citas2"]["aceptada"].disabled = !!info.event.extendedProps.aceptada;
                    document.forms["citas2"]["aceptada"].checked = info.event.extendedProps.aceptada
                    document.forms["citas2"]["title-disabled"].value = info.event.title
                    document.forms["citas2"]["title"].value = info.event.title
                    document.forms["citas2"]["start"].value = date.toString().split(' ')[4]
                    document.forms["citas2"]["descripcion"].value = info.event.extendedProps.descripcion
                    const selectMedico = document.getElementById('medico')
                    selectMedico.innerHTML = ''
                    medicos.forEach(medico => {
                        fetch(`/medicos/${medico.id}`)
                            .then(value => value.json())
                            .then(value => {
                                selectMedico.innerHTML += `<option name="medico_id"
                                    value="${value.id}" ${(value.id == info.event.extendedProps.medico_id) && 'selected'}>
                                        ${value.nombre} ${value.apellido_paterno} ${value.apellido_materno}
                                </option>`
                            })
                    })

                    document.getElementById('cita2').addEventListener('submit', (e) => {
                        e.preventDefault()
                        swal({
                            title: "Cita Modificada",
                            icon: "success",
                            dangerMode: true,
                        }).then(() => {
                            document.getElementById('cita2').submit()
                        })
                    })

                    id = document.forms["citas2"]["id"].value = info.event.id
                },

                editable: true,

                eventDrop: function (info) {
                    const date = new Date(info.event.start)

                    const start = date.toString().split(' ')[4]

                    $.ajax({
                        url: "{{url('/citas')}}",
                        type: 'POST',
                        data: {
                            _method: "PATCH",
                            id: info.event.id,
                            day: info.event.startStr.split('T')[0],
                            descripcion: info.event.extendedProps.descripcion,
                            start,
                            _token: "{{ csrf_token() }}",
                            title: info.event.title
                        }
                    })

                }
            })

            document.getElementById('borrar').addEventListener('submit', (e) => {
                e.preventDefault()
                swal({
                    title: "Estas Seguro que deseas borrar esta cita?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((value) => {
                    if (value) {
                        swal({
                            title: "Cita borrada correctamente",
                            icon: "success",
                            dangerMode: true,
                        }).then(() => {
                            document.getElementById('borrar').submit()
                        })
                    } else {
                        e.preventDefault()
                    }
                })
                document.forms["borrar"]["id"].value = id
            })

            calendar.setOption('locale', 'es')
            calendar.render()
        })
    </script>
</x-app-layout>
