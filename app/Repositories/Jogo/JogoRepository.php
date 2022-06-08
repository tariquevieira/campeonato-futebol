<?php

namespace App\Repositories\Jogo;

use App\Models\Jogo;

interface JogoRepository
{
  public function buscaJogoPorId(Int $id): Jogo;
  public function buscaJogosPorFase(Int $idCampeonato, Int $fase): array;
}