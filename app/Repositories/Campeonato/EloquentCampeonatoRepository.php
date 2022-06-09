<?php

namespace App\Repositories\Campeonato;

use App\Models\Campeonato;

class EloquentCampeonatoRepository implements CampeonatoRepository
{
  public function __construct(private Campeonato $campeonato)
  {
  }

  /**
   * listaCampeonatos
   *
   * @return array
   */
  public function listaCampeonatos(): array
  {

    try {
      $campeonatos = $this->campeonato->all()->toArray();
      return $campeonatos;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }

  /**
   * criaCampeonato
   *
   * @param String $nome
   * @return Campeonato
   */
  public function criaCampeonato(String $nome): Campeonato
  {
    try {
      $campeonato = $this->campeonato->create(["nome" => $nome]);
      return $campeonato;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
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
      $campeonato = $this->campeonato->find($id);
      return $campeonato;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }

  /**
   * atualizaCampeonato
   *
   * @param String $nome
   * @param Int $id
   * @return boolean
   */
  public function atualizaCampeonato(String $nome, Int $id): bool
  {
    try {
      $campeonato = $this->campeonato->find($id);
      $campeonato->nome = $nome;
      $campeonato->save();
      return true;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }
  /**
   * deletaCampeonato
   *
   * @param Int $id
   * @return boolean
   */
  public function deletaCampeonato(Int $id): bool
  {
    try {
      $campeonato = $this->campeonato->find($id);
      $campeonato->delete();
      return true;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage);
    }
  }
}