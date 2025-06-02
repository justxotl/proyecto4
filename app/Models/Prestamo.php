<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;
    protected $table = 'prestamos';

    protected $fillable = [
        'id',
        'ficha_id',
        'prestatario_id',
        'fecha_prestamo',
        'fecha_devolucion',
        'fecha_entrega',
        'estado',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    public function prestatario()
    {
        return $this->belongsTo(Prestatario::class);
    }
}
