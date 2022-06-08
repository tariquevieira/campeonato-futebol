<?php

namespace App\Repositories\Jogo;

use App\Models\Jogo;

class EloquentJogorepository implements JogoRepository
{
  public function __construct(private Jogo $jogo)
  {
  }

  /**
   * buscaJogoPorId
   *
   * @param Int $id
   * @return Jogo
   */
  public function buscaJogoPorId(Int $id): Jogo
  {
    try {
      $jogo = $this->jogo->find($id);
      return $jogo;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }

  public function buscaJogosPorFase(Int $idCampeonato, Int $fase): array
  {
    try {
      $jogos = $this->jogo->where('fase', $fase)
        ->where('id', $idCampeonato)->get()->toArray();
      return $jogos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }
}