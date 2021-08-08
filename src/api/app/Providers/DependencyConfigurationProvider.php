<?php

namespace src\Providers;

use Illuminate\Support\ServiceProvider;
use src\Business\Helpers\MunaPatternChecker;
use src\Business\Helpers\PatternCheckerInterface;

class DependencyConfigurationProvider extends ServiceProvider
{
    public function bindAbstractToConcrete()
    {
        $this->app->bind(PatternCheckerInterface::class, MunaPatternChecker::class);
    }

    public function boot()
    {
        $this->bindAbstractToConcrete();
    }
}