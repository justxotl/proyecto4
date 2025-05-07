<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreguntaUser extends Model
{
    use HasFactory;

    protected $table = 'preguntas_user';
    
    protected $fillable = [
        'user_id',
        'pregunta_uno',
        'respuesta_uno',
        'pregunta_dos',
        'respuesta_dos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
