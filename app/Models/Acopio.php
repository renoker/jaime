<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acopio extends Model
{
    use HasFactory, SoftDeletes;

    public function facturation()
    {
        return $this->hasOne(Facturation::class);
    }
}
