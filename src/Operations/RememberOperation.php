<?php

namespace Goldenfavour\CacheSync\Operations;

use Goldenfavour\CacheSync\CacheManager;
use Closure;

class RememberOperation
{
    public function __construct(protected CacheManager $cache) {}

    public function handle(string $key, Closure $fetch, mixed $ttl = null): mixed
    {
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $value = $fetch();

        $this->cache->put($key, $value, $ttl);

        return $value;
    }
}
