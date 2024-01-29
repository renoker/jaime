<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicinesPatient extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }

    public function getTiempoRestanteMedicamentoAttribute()
    {
        // Buscar el medicamento que le asignaron al paciente
        $contenido_caja_medicamento = Medicines::find($this->medicine_id)->contenido;
        // Fecha de entrega
        $fechaEntrega = Carbon::parse($this->created_at);
        // Fecha actual
        $diaActual = Carbon::now();
        // Tiempo que ha pasado desde el día que se le entrego el medicamento
        $diasTranscurridos = $fechaEntrega->diffInDays($diaActual);
        // Cuantas dosis de medicamento le tocan en un día
        $dosis_por_dia = 24 / $this->periodicidad;
        // Cuantos días tendra medicamento el paciente
        $dias_de_medicamento = $contenido_caja_medicamento / $dosis_por_dia;
        //Multiplicado por el número de cajas 
        $dias_de_medicamento_por_cajas = $dias_de_medicamento * $this->no_cajas;
        // Tiempo restante con medicamento
        $tiempo = $dias_de_medicamento_por_cajas - $diasTranscurridos;

        if ($tiempo > 1) {
            return $tiempo . ' días';
        } else {
            return $tiempo . ' día';
        }
    }

    public function getFechaEntregaAttribute()
    {
        $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $fecha = Carbon::parse($this->created_at);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
    }

    public function getFechaTerminoMedicamentoAttribute()
    {
        // Buscar el medicamento que le asignaron al paciente
        $contenido_caja_medicamento = Medicines::find($this->medicine_id)->contenido;
        $dosis_por_dia = 24 / $this->periodicidad;
        // Cuantos días tendra medicamento el paciente
        $dias_de_medicamento = $contenido_caja_medicamento / $dosis_por_dia;
        $dias_de_medicamento_por_cajas = $dias_de_medicamento * $this->no_cajas;

        $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $fecha = Carbon::parse($this->created_at)->addDays($dias_de_medicamento_por_cajas);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
    }
}
