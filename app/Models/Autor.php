<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Autor extends Model
{
    use HasFactory;
    protected $table = 'autors';
    
    protected $fillable = [
        'ci_autor',
        'nombre_autor',
        'apellido_autor',
    ];

    public function ficha()
    {
        return $this->belongsToMany(Ficha::class);
    }
}
