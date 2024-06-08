<?php

namespace App\Models;

use App\Traits\ReverseGeocodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory, ReverseGeocodeTrait;

    protected $table = 'sucursales';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Salas()
    {
        return $this->hasMany(Sala::class, 'sucursal_id');
    }

}
