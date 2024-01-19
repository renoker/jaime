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
                <a href="{{ route($index, $acopio->id) }}" class="text-primary hover:underline">{{ $view }}</a>
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
                            <input type="hidden" name="acopio_id" value="{{ $acopio->id }}">
                            <input type="text" placeholder="Compañia" name="compania" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la compañia</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Nombre" name="name" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el nombre</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Teléfono" name="phone" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa el teléfono</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Teléfono" name="address" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la dirección 1</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Teléfono" name="address_two" class="form-input" />
                            <span class="mt-1 inline-block text-[11px] text-white-dark">Ingresa la dirección 2</span>
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
