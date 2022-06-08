<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
  use HasFactory;
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'jogos';
  protected $fillable = ['time_mandante_id', 'time_visitante_id', 'campeonato_id', 'fase', 'gols_time_mandante', 'gols_time_visitante'];

  public function campeonato()
  {
    return $this->belongsTo(Campeonato::class, 'campeonato_id', 'id');
  }

  public function timeMandante()
  {
    return $this->belongsTo(Time::class, 'time_mandante_id', 'id');
  }
  public function timeVisitante()
  {
    return $this->belongsTo(Time::class, 'time_visitante_id', 'id');
  }
}
