<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $table = 'salas';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function Mesas()
    {
        return $this->hasMany(Mesa::class, 'sala_id');
    }

    public function ListaReproduccion()
    {
        return $this->hasMany(ListaReproduccion::class, 'sala_id');
    }

}
