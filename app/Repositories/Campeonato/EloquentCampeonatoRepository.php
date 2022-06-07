<?php

namespace App\Repositories\Campeonato;

use App\Models\Campeonato;

class EloquentCampeonatoRepository implements CampeonatoRepository
{
  public function __construct(private Campeonato $campeonato)
  {
  }

  /**
   * listaCampeonatos
   *
   * @return array
   */
  public function listaCampeonatos(): array
  {
    try {
      $campeonatos = $this->campeonato->all()->toArray();
      return $campeonatos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }

  public function criarCampeonato(String $nome): Campeonato
  {
    try {
      $campeonato = $this->campeonato->create(["nome" => $nome]);
      return $campeonato;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }
}