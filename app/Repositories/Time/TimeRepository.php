<?php

namespace App\Repositories\Time;

use App\Models\Time;

interface TimeRepository
{
  public function listaTimes(): array;
  public function criaTime(String $nome): Time;
  public function buscaTimePorId(Int $id): Time;
  public function atualizaTime(String $nome, Int $id): bool;
  public function deletaTime(Int $id): bool;
}
