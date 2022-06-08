<?php

namespace App\Providers;

use App\Repositories\Campeonato\CampeonatoRepository;
use App\Repositories\Campeonato\EloquentCampeonatoRepository;
use App\Repositories\Time\EloquentTimeRepository;
use App\Repositories\Time\TimeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        CampeonatoRepository::class => EloquentCampeonatoRepository::class,
        TimeRepository::class => EloquentTimeRepository::class
    ];
}