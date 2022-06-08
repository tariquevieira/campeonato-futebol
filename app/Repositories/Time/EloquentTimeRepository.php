<?php

namespace App\Repositories\Time;

use App\Models\Time;

class EloquentTimeRepository implements TimeRepository
{
  public function __construct(private Time $time)
  {
  }

  /**
   * listaTimes
   *
   * @return array
   */
  public function listaTimes(): array
  {

    try {
      $times = $this->time->all()->toArray();
      return $times;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }

  /**
   * criaTime
   *
   * @param String $nome
   * @return Time
   */
  public function criaTime(String $nome): Time
  {
    try {
      $time = $this->time->create(["nome" => $nome]);
      return $time;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }

  /**
   * buscaTimePorId
   *
   * @param Int $id
   * @return Time
   */
  public function buscaTimePorId(Int $id): Time
  {
    try {
      $Time = $this->time->find($id);
      return $Time;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
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
      $Time = $this->time->find($id);
      $Time->nome = $nome;
      $Time->save();
      return true;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }

  public function deletaTime(Int $id): bool
  {
    try {
      $Time = $this->time->find($id);
      $Time->delete();
      return true;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }
}