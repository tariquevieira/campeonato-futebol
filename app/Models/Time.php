<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $table = 'times';
    protected $fillable = ['nome'];

    public function jogosMandante()
    {
        return $this->hasMany(Jogo::class, 'time_mandante_id', 'id');
    }

    public function jogosVisitante()
    {
        return $this->hasMany(Jogo::class, 'time_visitante_id', 'id');
    }
}