<?php

namespace App\Services\Jogo;

use App\Models\Jogo;
use App\Repositories\Jogo\JogoRepository;

class JogoService
{
  public function __construct(private JogoRepository $repositorio)
  {
  }

  public function buscaJogoPorId($idJogo): Jogo
  {
    try {
      return $this->repositorio->buscaJogoPorId($idJogo);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * Undocumented function
   *
   * @param Jogo $jogo
   * @return Int
   */
  public function retornaVencedorJogo(Jogo $jogo): Int
  {

    if ($jogo->gols_time_mandante > $jogo->gols_time_visitante) {
      return $jogo->time_mandante;
    }
    return $jogo->gols_time_visitante;
  }

  public function pontosTimeMandante(Jogo $jogo): Int
  {
    return $jogo->gols_time_mandante - $jogo->gols_time_visitante;
  }
  public function pontosTimeVisitante(Jogo $jogo): Int
  {
    return $jogo->gols_time_visitante - $jogo->gols_time_mandante;
  }

  public function existeJogosDeQuartasFinal(Int $idCampeonato): bool
  {
    try {
      $jogos = $this->repositorio->buscaJogosPorFase($idCampeonato, 4);
      if (count($jogos) == 4) {
        return true;
      }
      return false;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function existeJogosDeSemiFinal(Int $idCampeonato): bool
  {
    try {
      $jogos = $this->repositorio->buscaJogosPorFase($idCampeonato, 2);
      if (count($jogos) == 1) {
        return true;
      }
      return false;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function existeJogoTerceiroLugar(Int $idCampeonato): bool
  {
    try {
      $jogos = $this->repositorio->buscaJogosPorFase($idCampeonato, 3);
      if (count($jogos) == 1) {
        return true;
      }
      return false;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
}