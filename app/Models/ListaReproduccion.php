<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaReproduccion extends Model
{
    use HasFactory;
    protected $table = 'lista_reproduccion';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function Mesa()
    {
        return $this->belongsTo(Mesa::class, 'mesa_is');
    }
}
