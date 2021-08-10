<?php

namespace src\Providers;

use Illuminate\Support\ServiceProvider;
use src\Business\Helpers\MunaPatternChecker;
use src\Business\Helpers\PatternCheckerInterface;
use src\Data\Entities\EntityInterface;
use src\Data\Entities\HistoryItem;
use src\Data\Entities\Info;
use src\Data\Repositories\InfoRepository;
use src\Data\Storage\CacheInterface;
use src\Data\Storage\RedisStorage;
use src\Data\Storage\RepositoryInterface;
use src\Data\Storage\SqlStorage;

class DependencyConfigurationProvider extends ServiceProvider
{
    public function bindAbstractToConcrete()
    {
        $this->app->bind(PatternCheckerInterface::class, MunaPatternChecker::class);
        $this->app->bind(RepositoryInterface::class, SqlStorage::class);
        $this->app->bind(CacheInterface::class, RedisStorage::class);

        $this->app->bind(EntityInterface::class, HistoryItem::class);
        $this->app->bind(EntityInterface::class, Info::class);
    }

    public function boot()
    {
        $this->bindAbstractToConcrete();
    }
}