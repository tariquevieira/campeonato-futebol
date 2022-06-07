<?php

namespace App\Repositories\Campeonato;

use App\Models\Campeonato;

interface CampeonatoRepository
{
  public function listaCampeonatos(): array;
  public function criarCampeonato(String $nome): Campeonato;
}