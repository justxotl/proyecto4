<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class infoper extends Model
{
    protected $fillable = [
        'ci_us',
        'nombre',
        'apellido',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
