<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;
    protected $table = 'pedidos_detalles';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
