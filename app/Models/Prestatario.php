<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestatario extends Model
{
    use HasFactory;

    protected $table = 'prestatarios';

    protected $fillable = [
        'ci_prestatario',
        'nombre_prestatario',
        'apellido_prestatario',
        'tlf_prestatario'
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
