<?php

namespace App\Services\Utils\Dominio\GeradorDeGols;

class GeradorDeGolsPhp implements GeradorDeGolsService
{
  public function getGolsPorTime(): array
  {
    $minimo = 0;
    $maximo = 8;
    return [
      'time_mandante' => rand($minimo, $maximo),
      'time_visitante' => rand($minimo, $maximo),
    ];
  }
}