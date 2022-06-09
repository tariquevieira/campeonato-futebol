<?php

namespace App\Services\Time;

use App\Models\Time;
use App\Repositories\Time\TimeRepository;

class TimeService
{
  public function __construct(private TimeRepository $repositorio)
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
      return $this->repositorio->listaTimes();
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   *criaTime
   * @param String $nome
   * @return void
   */
  public function criaTime(String $nome)
  {
    try {
      return $this->repositorio->criaTime($nome);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }


  /**
   * buscaTimePorId
   *
   * @param Int $id
   * @return void
   */
  public function buscaTimePorId(Int $id): Time
  {
    try {
      return $this->repositorio->buscaTimePorId($id);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * atualizaTime
   *
   * @param String $nome
   * @param Int $id
   * @return boolean
   */
  public function atualizaTime(String $nome, Int $id): bool
  {
    try {
      $registroAtualzado = $this->repositorio->atualizaTime($nome, $id);
      if ($registroAtualzado) {
        return $registroAtualzado;
      }
      throw new \Exception("Não foi possivel atualizar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * deletaTime
   *
   * @param Int $id
   * @return boolean
   */
  public function deletaTime(Int $id): bool
  {
    try {
      $deletado = $this->repositorio->deletaTime($id);
      if ($deletado) {
        return $deletado;
      }

      throw new \Exception("Não foi possivel deletar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * todosTimes
   *
   * @return array
   */
  public static function todosTimes(): array
  {
    try {
      $times = Time::all(['id'])->toArray();
      return $times;
    } catch (\Exception $e) {
      throw new \Exception("Erro ao buscar todos os times");
    }
  }
}