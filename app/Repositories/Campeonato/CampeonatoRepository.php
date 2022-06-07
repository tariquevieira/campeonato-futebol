<?php

namespace App\Repositories\Campeonato;

use App\Models\Campeonato;

interface CampeonatoRepository
{
  public function listaCampeonatos(): array;
  public function criaCampeonato(String $nome): Campeonato;
  public function buscaCampeonatoPorId(Int $id): Campeonato;
  public function atualizaCampeonato(String $nome, Int $id): bool;
  public function deletaCampeonato(Int $id): bool;
}