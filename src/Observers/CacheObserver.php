<?php

namespace Goldenfavour\CacheSync\Observers;

use Goldenfavour\CacheSync\CacheManager;
use Goldenfavour\CacheSync\Registry\CacheRegistry;

class CacheObserver
{
    public function __construct(protected CacheRegistry $registry, protected CacheManager $cache) {}

    public function saved(string $model): void
    {
        $this->refresh($model);
    }

    public function deleted(string $model): void
    {
        $this->refresh($model);
    }

    protected function refresh(string $model): void
    {
        foreach ($this->registry->forModel($model::class) as $resource) {

            $fresh = ($resource['fetch'])();

            $this->cache->put($resource['key'], $fresh, $resource['ttl']);
        }
    }
}
