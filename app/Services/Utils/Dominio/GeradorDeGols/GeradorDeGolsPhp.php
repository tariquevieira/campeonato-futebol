<?php

namespace App\Services\Utils\Dominio\GeradorDeGols;

class GeradorDeGolsPhp implements GeradorDeGolsService
{
  /**
   * Retorna nnúmero de gols gerato aleatoriamente
   *
   * @return array
   */
  public function getGolsJogo(): array
  {
    $minimo = 0;
    $maximo = 8;
    return [
      'time_mandante' => rand($minimo, $maximo),
      'time_visitante' => rand($minimo, $maximo),
    ];
  }
}