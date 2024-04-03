<?php

namespace App\Imports;

use App\Models\Medicines;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MedicamentosImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{

    use Importable;

    public function model(array $row)
    {

        return Medicines::updateOrCreate(
            [
                'clave' => $row['clave'],
            ],
            [
                'clave'             => $row['clave'],
                'descripcion'       => $row['descripcion'] ?? NULL,
                'principal_activo'  => $row['principio_activo'] ?? NULL,
                'laboratorio'       => $row['laboratorio'] ?? NULL,
                'iva'               => $row['iva'] ?? NULL,
                'pecio_maximo'      => $row['precio_maximo'] ?? NULL,
                // 'descuento'         => $row['descuento'] ?? NULL,
                'pecio'             => $row['precio'] ?? NULL,
                'pecio_anterior'    => $row['precio_anterior'] ?? NULL,
                // 'stock'             => $row['stock'] ?? NULL,
                'comentarios'         => $row['comentarios'] ?? NULL,
                'codigo_barras'     => $row['codigo_barras'] ?? NULL,
            ]
        );
    }

    public function rules(): array
    {
        return [
            'clave'   => 'required',
        ];
    }
}
