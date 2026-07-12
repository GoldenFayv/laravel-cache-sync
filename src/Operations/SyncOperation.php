<?php

namespace Goldenfavour\CacheSync\Operations;

use Goldenfavour\CacheSync\CacheManager;
use Closure;

class SyncOperation
{
    public function __construct(protected CacheManager $cache) {}

    public function handle(string $key, Closure $action, Closure $fetch, mixed $ttl = null): mixed
    {
        $action();

        $fresh = $fetch();

        $this->cache->put($key, $fresh, $ttl);

        return $fresh;
    }
}
