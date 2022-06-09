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

  public function buscaJogosPorFase(Int $idCampeonato, $fase): array
  {
    try {
      $jogos = $this->jogo->where('fase', $fase)
        ->where('id', $idCampeonato)->get()->toArray();
      return $jogos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }


  public function buscaQuartasFinal(Int $idCampeonato): array
  {
    try {
      $jogos = $this->jogo->buscaQuartasFinal()->where('campeonato_id', $idCampeonato)
        ->get()->toArray();
      return $jogos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
  public function buscaSemiFinal(Int $idCampeonato): array
  {
    try {
      $jogos = $this->jogo->buscaSemiFinal()->where('campeonato_id', $idCampeonato)
        ->get()->toArray();
      return $jogos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }
  public function buscaTerceiroLugar(Int $idCampeonato): array
  {
    try {
      $jogos = $this->jogo->buscaTerceiroLugar()->where('campeonato_id', $idCampeonato)
        ->get()->toArray();
      return $jogos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }
}
