<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Detalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'pedido_id');
    }

    public function Sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function Mesa()
    {
        return $this->belongsTo(Mesa::class, 'mesa_id');
    }
}
