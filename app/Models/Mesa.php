<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $table='mesas';
    protected $guarded=['id', 'created_at', 'updated_at'];

    public function Sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }
}
