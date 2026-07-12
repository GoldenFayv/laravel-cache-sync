<?php

namespace Goldenfavour\CacheSync\Providers;

use Goldenfavour\CacheSync\CacheManager;
use Goldenfavour\CacheSync\CacheSync;
use Goldenfavour\CacheSync\Operations\RememberOperation;
use Goldenfavour\CacheSync\Operations\SyncOperation;
use Goldenfavour\CacheSync\Registry\CacheRegistry;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CacheSyncServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CacheManager::class, function (Application $app) {
            return new CacheManager(
                $app->make(Factory::class)->store()
            );
        });

        $this->app->singleton(RememberOperation::class);
        $this->app->singleton(SyncOperation::class);
        $this->app->singleton(CacheSync::class);
        $this->app->singleton(CacheRegistry::class);
    }
}
