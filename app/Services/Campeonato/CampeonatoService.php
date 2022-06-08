<?php

namespace App\Services\Campeonato;

use App\Repositories\Campeonato\CampeonatoRepository;

class CampeonatoService
{

  public function __construct(private CampeonatoRepository $repository)
  {
  }

  /**
   * lista Campeonatos
   *
   * @return array
   */
  public function listaCampeonatos(): array
  {
    try {
      return $this->repository->listaCampeonatos();
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
      return $this->repository->criaCampeonato($nome);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function buscaCampeonatoPorId(Int $id)
  {
    try {
      return $this->repository->buscaCampeonatoPorId($id);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function atualizaCampeonato(String $nome, Int $id)
  {
    try {
      $registroAtualziado = $this->repository->atualizaCampeonato($nome, $id);
      if ($registroAtualziado) {
        return $registroAtualziado;
      }
      throw new \Exception("Não foi possivel atualizar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function deletaCampeonato(Int $id)
  {
    try {
      $deletado = $this->repository->deletaCampeonato($id);
      if ($deletado) {
        return $deletado;
      }

      throw new \Exception("Não foi possivel deletar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function existePrimeiraFase()
  {
  }
}