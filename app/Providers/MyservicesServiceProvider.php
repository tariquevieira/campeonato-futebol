<?php

namespace App\Providers;

use App\Services\Campeonato\CampeonatoService;
use App\Services\Utils\Dominio\GeradorDeGols\GeradorDeGolsPython;
use App\Services\Utils\Dominio\GeradorDeGols\GeradorDeGolsService;
use Illuminate\Support\ServiceProvider;

class MyservicesServiceProvider extends ServiceProvider
{
  public array $bindings = [
    GeradorDeGolsService::class => GeradorDeGolsPython::class,

  ];
}