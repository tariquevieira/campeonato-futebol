<?php

namespace App\Providers;

use App\Repositories\Campeonato\CampeonatoRepository;
use App\Repositories\Campeonato\EloquentCampeonatoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        CampeonatoRepository::class => EloquentCampeonatoRepository::class
    ];
}