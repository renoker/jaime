@extends('layouts.main')
@section('titulo', 'Jaime - Editar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/flatpickr.min.css') }}" />
@endsection
@section('content')
    <!-- start main content section -->
    <div x-data="form">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route($index) }}" class="text-primary hover:underline">{{ $view }}</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Editar</span>
            </li>
        </ul>
        <div class="grid grid-cols-2 gap-2 pt-5 lg:grid-cols-1">
            <!-- Stack -->
            <div class="panel">
                <div class="mb-5">
                    <form action="{{ route($update, $row) }}" method="POST" class="space-y-5"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <img src="{{ url($row->image) }}" alt="" width="100px">
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Imagen actual</span>
                        </div>
                        <div>
                            <input id="ctnFile" type="file" name="image"
                                class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la imagen</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Nombre" name="name" value="{{ $row->name }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el nombre</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Edad" name="edad" value="{{ $row->edad }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la cantidad que tienes el
                                producto</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Profeción" name="profecion" value="{{ $row->profecion }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la profeción</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Dirección" name="direccion" value="{{ $row->direccion }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la dirección</span>
                        </div>
                        <div>
                            <div x-data="form">
                                <input id="basic" name="cumpleanios" x-model="date1" class="form-input" />
                            </div>
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la fecha de nacimiento del
                                paciente</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Email" name="email" value="{{ $row->email }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el email</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Teléfono" name="telefono" value="{{ $row->telefono }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el Teléfono</span>
                        </div>
                        <div>
                            <select class="form-select text-white-dark" name="acopio_id">
                                <option value="0">Selecciona el nivel de acceso del este usuario</option>
                                @foreach ($acopios as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $row->acopio_id) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Selecciona el nivel de acceso del
                                este usuario</span>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Actualizar</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- end main content section -->


@endsection

@section('scripts')
    <!-- start hightlight js -->
    <link rel="stylesheet" href="{{ url('assets/css/highlight.min.css') }}" />
    <script src="{{ url('assets/js/highlight.min.js') }}"></script>
    <!-- end hightlight js -->
    <script src="{{ url('assets/js/flatpickr.js') }}"></script>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                date1: '{{ $row->cumpleanios }}',
                init() {
                    flatpickr(document.getElementById('basic'), {
                        dateFormat: 'Y-m-d',
                        defaultDate: this.date1,
                    })
                }
            }));
        });
    </script>
@endsection
