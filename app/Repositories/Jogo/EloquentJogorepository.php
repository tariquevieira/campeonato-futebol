<?php

namespace App\Repositories\Jogo;

use App\Models\Jogo;
use Illuminate\Support\Facades\DB;

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

  /**
   * buscaJogosPorFase
   *
   * @param Int $idCampeonato
   * @param [type] $fase
   * @return array
   */
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

  /**
   * buscaQuartasFinal
   *
   * @param Int $idCampeonato
   * @return array
   */
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

  /**
   * buscaSemiFinal
   *
   * @param Int $idCampeonato
   * @return array
   */
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

  /**
   * buscaTerceiroLugar
   *
   * @param Int $idCampeonato
   * @return array
   */
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

  /**
   * criaJogo
   *
   * @param Int $timeMandante
   * @param Int $timeVisitantante
   * @param Int $idCampeonato
   * @param String $fase
   * @param Int $golsTimeMandante
   * @param Int $golsTimeVisitantante
   * @return Jogo
   */
  public function criaJogo(
    Int $timeMandante,
    Int $timeVisitantante,
    Int $idCampeonato,
    String $fase,
    Int $golsTimeMandante,
    Int $golsTimeVisitantante
  ): Jogo {
    $dadosJogo = [
      'time_mandante' => $timeMandante,
      'time_visitantante' => $timeVisitantante,
      'campeonato_id' => $idCampeonato,
      'fase' => $fase,
      'gols_time_mandante' => $golsTimeMandante,
      'gols_time_visitante' => $golsTimeVisitantante,
    ];

    try {
      $jogo = $this->jogo->create($dadosJogo);
      return $jogo;
    } catch (\Exception $e) {

      $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro não foi possivel cadastrar o jogo';
      throw new \Exception($e->getMessage);
    }
  }

  public function criajogos(array $dadosJogos): array
  {
    try {
      $arrayJogos = [];
      DB::beginTransaction();
      foreach ($dadosJogos as $jogo) {
        $arrayJogos[] = $this->jogo->create(
          [
            'time_mandante' => $jogo['timeMandante'],
            'time_visitantante' => $jogo['timeVisitantante'],
            'campeonato_id' => $jogo['idCampeonato'],
            'fase' => $jogo['fase'],
            'gols_time_mandante' => $jogo['timeMandante'],
            'gols_time_visitante' => $jogo['timeVisitantante'],
          ]
        );
      }
      DB::commit();
      return $arrayJogos;
    } catch (\Exception $e) {
      DB::rollback();
      $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro não foi possivel cadastrar os jogos';
      throw new \Exception($e->getMessage);
    }
  }
}