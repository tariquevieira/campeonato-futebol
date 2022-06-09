<?php

namespace App\Services\Campeonato;

use App\Models\Campeonato;
use App\Repositories\Campeonato\CampeonatoRepository;
use App\Services\Jogo\JogoService;
use App\Services\Time\TimeService;


class CampeonatoService
{
  public function __construct(
    private CampeonatoRepository $repositorio,
    private JogoService $jogoService
  ) {
  }

  /**
   * lista Campeonatos
   *
   * @return array
   */
  public function listaCampeonatos(): array
  {
    try {
      return $this->repositorio->listaCampeonatos();
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * 
   *
   * @param String $nome
   * @return void
   */
  public function criaCampeonato(String $nome)
  {
    try {
      return $this->repositorio->criaCampeonato($nome);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * buscaCampeonatoPorId
   *
   * @param Int $id
   * @return Campeonato
   */
  public function buscaCampeonatoPorId(Int $id): Campeonato
  {
    try {
      return $this->repositorio->buscaCampeonatoPorId($id);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * atualizaCampeonato
   *
   * @param String $nome
   * @param Int $id
   * @return void
   */
  public function atualizaCampeonato(String $nome, Int $id)
  {
    try {
      $registroAtualziado = $this->repositorio->atualizaCampeonato($nome, $id);
      if ($registroAtualziado) {
        return $registroAtualziado;
      }
      throw new \Exception("Não foi possivel atualizar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * deletaCampeonato
   *
   * @param Int $id
   * @return void
   */
  public function deletaCampeonato(Int $id)
  {
    try {
      $deletado = $this->repositorio->deletaCampeonato($id);
      if ($deletado) {
        return $deletado;
      }

      throw new \Exception("Não foi possivel deletar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * quartasDeFinal - retorna os jogos da Quarta de final
   *
   * @param Int $idCampeonato
   * @return array
   */
  public function quartasDeFinal(Int $idCampeonato): array
  {
    try {
      if ($this->jogoService->existeJogosDeQuartasFinal($idCampeonato)) {
        return $this->jogoService->jogosQuartasDeFinal($idCampeonato);
      }
      return  $this->criaQuartasDeFinal($idCampeonato);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * criaQuartasDeFinal
   *
   * @param [type] $idCampeonato
   * @return array
   */
  public function criaQuartasDeFinal($idCampeonato): array
  {
    try {
      $times = $this->geraTimesParaQuartaDeFinal();
      $arrayJogos = [];

      for ($i = 0; $i < 7; $i = $i + 2) {
        $arrayJogos[] = [
          "timeMandante" => $times[$i],
          "timeMandante" => $times[$i + 1],
          "idCampeonato" => $idCampeonato,
          "fase" => 'q'
        ];
      }
      $arrayJogos = $this->jogoService->criaJogos($arrayJogos);

      return $arrayJogos;
    } catch (\Exception $e) {

      throw new \Exception($e->getMessage());
    }
  }

  /**
   * geraTimesParaQuartaDeFinal
   *
   * @return void
   */
  private function geraTimesParaQuartaDeFinal()
  {
    try {
      $times = TimeService::todosTimes();
      $timesEscolhidos = [];
      $maximo = count($times);
      for ($i = 0; $i < 7; $i++) {

        $timesEscolhidos[] = $times[$i]['id'];
      }

      return $timesEscolhidos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
}