<?php

namespace Goldenfavour\CacheSync;

use Illuminate\Contracts\Cache\Repository;

class CacheManager
{
    public function __construct(protected Repository $cache) {}

    public function has(string $key): bool
    {
        return $this->cache->has($key);
    }

    public function get(string $key): mixed
    {
        return $this->cache->get($key);
    }

    public function put(string $key, mixed $value, mixed $ttl = null): bool
    {
        return $this->cache->add($key, $value, $ttl);
    }

    public function forget(string $key): bool
    {
        return $this->cache->forget($key);
    }
}
