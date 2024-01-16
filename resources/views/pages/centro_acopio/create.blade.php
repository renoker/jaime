@extends('layouts.main')
@section('titulo', 'Jaime - Agregar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/file-upload-with-preview.min.css') }}" />
@endsection
@section('content')
    <!-- start main content section -->
    <div x-data="form">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route($index) }}" class="text-primary hover:underline">{{ $view }}</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Crear</span>
            </li>
        </ul>
        <div class="grid grid-cols-2 gap-2 pt-5 lg:grid-cols-1">
            <!-- Stack -->
            <div class="panel">
                <div class="mb-5">
                    <form action="{{ route($store) }}" method="POST" class="space-y-5" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div>
                            <input id="ctnFile" type="file" name="image"
                                class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la imagen</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Nombre" name="name" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el nombre</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Cantidad" name="contenido" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la cantidad que tienes el
                                medicamento</span>
                        </div>
                        <div>
                            <select class="form-select text-white-dark" name="level_id">
                                <option value="0">Selecciona el nivel de acceso del este usuario</option>
                                @foreach ($statesMedication as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->state }}</option>
                                @endforeach
                            </select>
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Selecciona el nivel de acceso del
                                este usuario</span>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Agregar</button>
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
