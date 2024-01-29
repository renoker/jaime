<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['fecha_sistema', 'total', 'fecha_solicitud'];

    public function acopio()
    {
        return $this->belongsTo(Acopio::class);
    }

    public function status_orden()
    {
        return $this->belongsTo(StatusOrden::class);
    }

    public function getFechaSolicitudAttribute()
    {
        $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $fecha = \Carbon\Carbon::parse($this->fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
    }

    public function getFechaSistemaAttribute()
    {
        $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $fecha = \Carbon\Carbon::parse($this->cumpleanios);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
    }

    public function getTotalAttribute()
    {
        $result = OrdenMedina::where('order_id', $this->id)->selectRaw('SUM(pecio * cantidad) as total')->first();
        return number_format($result->total, 2);
    }
}
