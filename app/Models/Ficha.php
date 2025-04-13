<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;
    protected $table = 'fichas';

    protected $fillable = [
        'titulo',
        'fecha',
        'carrera_id',
        'resumen',
    ];

    public function autor()
    {
        return $this->hasOne(Autor::class);
    }
}
