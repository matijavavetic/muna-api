<?php

namespace src\Providers;

use Illuminate\Support\ServiceProvider;
use src\Business\Helpers\MunaPatternChecker;
use src\Business\Helpers\Contracts\PatternCheckerInterface;
use src\Data\Entities\Contracts\EntityInterface;
use src\Data\Entities\HistoryItem;
use src\Data\Entities\Info;
use src\Data\Repositories\Contracts\CacheInterface;
use src\Data\Repositories\DoctrineRepository;
use src\Data\Repositories\RedisRepository;
use src\Data\Repositories\Contracts\RepositoryInterface;

class DependencyConfigurationProvider extends ServiceProvider
{
    public function bindAbstractToConcrete(): void
    {
        $this->app->bind(PatternCheckerInterface::class, MunaPatternChecker::class);
        $this->app->bind(RepositoryInterface::class, DoctrineRepository::class);
        $this->app->bind(CacheInterface::class, RedisRepository::class);
        $this->app->bind(EntityInterface::class, HistoryItem::class);
        $this->app->bind(EntityInterface::class, Info::class);
    }

    public function boot(): void
    {
        $this->bindAbstractToConcrete();
    }
}