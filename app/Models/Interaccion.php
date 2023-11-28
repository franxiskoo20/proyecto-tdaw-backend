<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    use HasFactory;
    
    protected $table = 'interacciones';

    protected $fillable = [
        'perro_interesado_id',
        'perro_candidato_id',
        'preferencia',
    ];

    // Relaciones
    public function perroInteresado()
    {
        return $this->belongsTo(Perro::class, 'perro_interesado_id');
    }

    public function perroCandidato()
    {
        return $this->belongsTo(Perro::class, 'perro_candidato_id');
    }
}