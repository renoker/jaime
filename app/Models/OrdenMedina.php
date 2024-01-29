<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenMedina extends Model
{
    use HasFactory, SoftDeletes;

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
