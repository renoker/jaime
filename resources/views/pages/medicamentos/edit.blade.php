@extends('layouts.main')
@section('titulo', 'Comunidad religiosa - Editar')
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
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa la imagen</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Clave" name="clave" value="{{ $row->clave }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa la clave</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Descripción" name="descripcion"
                                value="{{ $row->descripcion }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa la descripción</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Activo Principal" name="principal_activo"
                                value="{{ $row->principal_activo }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el activo principal</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Laboratorio" name="laboratorio"
                                value="{{ $row->laboratorio }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el laboratorio</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Comentarios" name="comentarios"
                                value="{{ $row->comentarios }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa tus comentarios</span>
                        </div>
                        <div>
                            <input type="text" placeholder="Código de barras" name="codigo_barras"
                                value="{{ $row->codigo_barras }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el código barras</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Precio anterior" name="pecio_anterior"
                                value="{{ number_format($row->pecio_anterior, 2, '.', '') }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el pecio anterior</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Precio" name="pecio"
                                value="{{ number_format($row->pecio, 2, '.', '') }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el pecio</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Precio máximo" name="pecio_maximo"
                                value="{{ number_format($row->pecio_maximo, 2, '.', '') }}" class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el pecio máximo</span>
                        </div>
                        <div>
                            <input type="number" placeholder="IVA" name="iva" value="{{ $row->iva }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el IVA</span>
                        </div>
                        <div>
                            <input type="number" placeholder="Stock" name="stock" value="{{ $row->stock }}"
                                class="form-input" />
                            <span class="mt-1 inline-block text-[20px] text-white-dark">Ingresa el stock</span>
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
