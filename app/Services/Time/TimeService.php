<?php

namespace App\Services\Time;

use App\Repositories\Time\TimeRepository;

class TimeService
{
  public function __construct(private TimeRepository $repository)
  {
  }

  /**
   * lista Times
   *
   * @return array
   */
  public function listaTimes(): array
  {
    try {
      return $this->repository->listaTimes();
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
  public function criaTime(String $nome)
  {
    try {
      return $this->repository->criaTime($nome);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function buscaTimePorId(Int $id)
  {
    try {
      return $this->repository->buscaTimePorId($id);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function atualizaTime(String $nome, Int $id)
  {
    try {
      $registroAtualziado = $this->repository->atualizaTime($nome, $id);
      if ($registroAtualziado) {
        return $registroAtualziado;
      }
      throw new \Exception("Não foi possivel atualizar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function deletaTime(Int $id)
  {
    try {
      $deletado = $this->repository->deletaTime($id);
      if ($deletado) {
        return $deletado;
      }

      throw new \Exception("Não foi possivel atualizar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
}