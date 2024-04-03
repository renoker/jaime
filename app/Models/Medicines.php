<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicines extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medicines';

    protected $fillable = [
        'image',
        'clave',
        'descripcion',
        'principal_activo',
        'laboratorio',
        'iva',
        'pecio_maximo',
        'descuento',
        'pecio',
        'pecio_anterior',
        'stock',
        'contenido',
        'comentarios',
        'caducidad',
        'codigo_barras'
    ];
}
