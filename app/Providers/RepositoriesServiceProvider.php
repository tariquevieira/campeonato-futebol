<?php

namespace App\Providers;

use App\Repositories\Campeonato\CampeonatoRepository;
use App\Repositories\Campeonato\EloquentCampeonatoRepository;
use App\Repositories\Jogo\EloquentJogorepository;
use App\Repositories\Jogo\JogoRepository;
use App\Repositories\Time\EloquentTimeRepository;
use App\Repositories\Time\TimeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CampeonatoRepository::class => EloquentCampeonatoRepository::class,
        TimeRepository::class => EloquentTimeRepository::class,
        JogoRepository::class => EloquentJogorepository::class
    ];
}