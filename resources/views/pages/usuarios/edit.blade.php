@extends('layouts.main')
@section('titulo', 'Jaime - Editar')

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
                    <form action="{{ route($update, $row) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')
                        <div>
                            <select class="form-select text-white-dark" name="genre">
                                <option value="0">Selecciona el genero de este usuario</option>
                                <option value="Hombre" @if ($row->genre == 'Hombre') selected @endif>Hombre</option>
                                <option value="Mujer" @if ($row->genre == 'Mujer') selected @endif>Mujer</option>
                            </select>
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Selecciona el genero de este
                                usuario</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Nombre" name="name" value="{{ $row->name }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el nombre</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Edad" name="age" value="{{ $row->age }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la Edad</span>
                        </div>
                        <div>
                            <input type="tel" placeholder="Teléfono" name="phone" value="{{ $row->phone }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el Teléfono</span>
                        </div>
                        <div>
                            <select class="form-select text-white-dark" name="level_id">
                                <option value="0">Selecciona el nivel de acceso del este usuario</option>
                                @foreach ($levels as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $row->level_id) selected @endif>
                                        {{ $item->level }}</option>
                                @endforeach
                            </select>
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Selecciona el nivel de acceso del
                                este usuario</span>
                        </div>
                        <div>
                            <input type="email" placeholder="Correo Electrónico" name="email"
                                value="{{ $row->email }}" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el correo
                                electrónico</span>
                        </div>
                        <div>
                            <input type="password" placeholder="Contraseña" name="password" value="{{ $row->password }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la contraseña</span>
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
@endsection
