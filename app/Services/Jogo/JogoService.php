<?php

namespace App\Services\Jogo;

use App\Models\Jogo;
use App\Repositories\Jogo\JogoRepository;
use App\Services\Time\TimeService;

class JogoService
{
  private array $cacheQuartasDeFinal;
  private array $cacheSemiFinal;
  private array $cacheFinal;
  private array $cacheTerceiroLugar;

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


  public function criaQuartasDeFinal($idCampeonato): array
  {
    try {
      $times = $this->geraTimesParaQuartaDeFinal();
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  private function geraTimesParaQuartaDeFinal()
  {
    try {
      $times = TimeService::todosTimes();
      $timesEscolhidos = [];
      $quatidadesTimes = count($times);
      for ($i = 0; $i < 4; $i++) {
        $index = array_rand($times, 1);
        $timesEscolhidos[] = $times[$index]['id'];
        unset($times[$index]);
      }
      return $timesEscolhidos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
}