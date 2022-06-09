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
   * 
   *
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

  public function buscaTimePorId(Int $id)
  {
    try {
      return $this->repositorio->buscaTimePorId($id);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  public function atualizaTime(String $nome, Int $id)
  {
    try {
      $registroAtualziado = $this->repositorio->atualizaTime($nome, $id);
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
      $deletado = $this->repositorio->deletaTime($id);
      if ($deletado) {
        return $deletado;
      }

      throw new \Exception("Não foi possivel deletar o registro");
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

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