<?php

namespace App\Repositories\Jogo;

use App\Models\Jogo;

interface JogoRepository
{
  public function buscaJogoPorId(Int $id): Jogo;
  public function criaJogo(
    Int $timeMandante,
    Int $timeVisitantante,
    Int $idCampeonato,
    String $fase,
    Int $golsTimeMandante,
    Int $golsTimeVisitantante
  ): Jogo;
  public function criaJogos(array $dadosJogos): array;
  public function buscaQuartasFinal(Int $idCampeonato): array;
  public function buscaSemiFinal(Int $idCampeonato): array;
  public function buscaTerceiroLugar(Int $idCampeonato): array;
}
