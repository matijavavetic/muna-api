<?php

namespace src\Providers;

use Illuminate\Support\ServiceProvider;
use src\Data\Contracts\StorageInterface;
use src\Data\Storage\StarWarsApiClient;
use src\Data\Repositories\FilmRepository;
use src\Data\Repositories\Contracts\FilmRepositoryInterface;
use src\Data\Repositories\PersonRepository;
use src\Data\Repositories\Contracts\PersonRepositoryInterface;
use src\Data\Entities\Film;
use src\Data\Entities\Person;
use src\Data\Entities\Contracts\FilmEntityInterface;
use src\Data\Entities\Contracts\PersonEntityInterface;
use src\Data\Repositories\Contracts\PlanetRepositoryInterface;
use src\Data\Repositories\PlanetRepository;
use src\Data\Entities\Contracts\PlanetEntityInterface;
use src\Data\Entities\Planet;
use src\Data\Repositories\Contracts\StarshipRepositoryInterface;
use src\Data\Repositories\StarshipRepository;
use src\Data\Entities\Contracts\StarshipEntityInterface;
use src\Data\Entities\Starship;

class DependencyConfigurationProvider extends ServiceProvider
{
    public function BindAbstractToConcrete()
    {
        // Storage
        $this->app->bind(StorageInterface::class, StarWarsApiClient::class);

        // Repositories
        $this->app->bind(FilmRepositoryInterface::class, FilmRepository::class);
        $this->app->bind(PersonRepositoryInterface::class, PersonRepository::class);
        $this->app->bind(PlanetRepositoryInterface::class, PlanetRepository::class);
        $this->app->bind(StarshipRepositoryInterface::class, StarshipRepository::class);

        // Entities
        $this->app->bind(PersonEntityInterface::class, Person::class);
        $this->app->bind(PlanetEntityInterface::class, Planet::class);
        $this->app->bind(FilmEntityInterface::class, Film::class);
        $this->app->bind(StarshipEntityInterface::class, Starship::class);
    }

    public function boot()
    {
        $this->BindAbstractToConcrete();
    }
}