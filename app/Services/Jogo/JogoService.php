<?php

namespace App\Services\Jogo;

use App\Models\Jogo;
use App\Repositories\Jogo\JogoRepository;
use App\Services\Utils\Dominio\GeradorDeGols\GeradorDeGolsService;

class JogoService
{
  private array $cacheQuartasDeFinal;
  private array $cacheSemiFinal;
  private array $cacheFinal;
  private array $cacheTerceiroLugar;

  public function __construct(private JogoRepository $repositorio, private GeradorDeGolsService $golsService)
  {
  }

  /**
   * buscaJogoPorId
   *
   * @param [type] $idJogo
   * @return Jogo
   */
  public function buscaJogoPorId($idJogo): Jogo
  {
    try {
      return $this->repositorio->buscaJogoPorId($idJogo);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * criaJogo
   *
   * @param Int $timeMandante
   * @param Int $timeVisitantante
   * @param Int $idCampeonato
   * @param String $fase
   * @return Jogo
   */
  public function criaJogo(Int $timeMandante, Int $timeVisitantante, Int $idCampeonato, String $fase): Jogo
  {
    try {
      $golsJogo = $this->golsService->getGolsJogo();
      $jogo = $this->repositorio->criaJogo(
        $timeMandante,
        $timeVisitantante,
        $idCampeonato,
        $fase,
        $golsJogo['time_mandante'],
        $golsJogo['time_visitante']
      );

      return $jogo;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function criaJogos($dadosJogos)
  {
    try {

      foreach ($dadosJogos as $jogos) {
        $golsJogo = $this->golsService->getGolsJogo();
        $jogos['timeMandante'] = $golsJogo['time_mandante'];
        $jogos['timeVisitante'] = $golsJogo['time_visitante'];
      }
      return $this->repositorio->criaJogos($dadosJogos);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }



  /**
   * retornaVencedorJogo
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

  /**
   * pontosTimeMandante
   *
   * @param Jogo $jogo
   * @return Int
   */
  public function pontosTimeMandante(Jogo $jogo): Int
  {
    return $jogo->gols_time_mandante - $jogo->gols_time_visitante;
  }

  /**
   * pontosTimeVisitante
   *
   * @param Jogo $jogo
   * @return Int
   */
  public function pontosTimeVisitante(Jogo $jogo): Int
  {
    return $jogo->gols_time_visitante - $jogo->gols_time_mandante;
  }

  /**
   * existeJogosDeQuartasFinal
   *
   * @param Int $idCampeonato
   * @return boolean
   */
  public function existeJogosDeQuartasFinal(Int $idCampeonato): bool
  {
    try {

      $jogos = $this->repositorio->buscaQuartasFinal($idCampeonato);
      if (count($jogos) == 4) {
        $this->cacheQuartasDeFinal = $jogos;
        return true;
      }
      return false;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * existeJogosDeSemiFinal
   *
   * @param Int $idCampeonato
   * @return boolean
   */
  public function existeJogosDeSemiFinal(Int $idCampeonato): bool
  {
    try {
      $jogos = $this->repositorio->buscaSemiFinal($idCampeonato);

      if (count($jogos) == 1) {
        $this->cacheSemiFinal = $jogos;
        return true;
      }
      return false;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * existeJogoTerceiroLugar
   *
   * @param Int $idCampeonato
   * @return boolean
   */
  public function existeJogoTerceiroLugar(Int $idCampeonato): bool
  {
    try {
      $jogos = $this->repositorio->buscaTerceiroLugar($idCampeonato);
      if (count($jogos) == 1) {
        $this->cacheTerceiroLugar = $jogos;
        return true;
      }
      return false;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * jogosQuartasDeFinal
   *
   * @param Int $idCampeonato
   * @return array
   */
  public function jogosQuartasDeFinal(Int $idCampeonato): array
  {
    try {
      if (isset($this->cacheQuartasDeFinal)) {
        return $this->cacheQuartasDeFinal;
      }
      $jogos = $this->repositorio->buscaQuartasFinal($idCampeonato);
      return $jogos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
}
