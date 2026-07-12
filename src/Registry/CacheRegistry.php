<?php

namespace Goldenfavour\CacheSync\Registry;

class CacheRegistry
{
    protected array $resources = [];

    public function register(string $model, string $key, callable $fetch, mixed $ttl = null): void
    {
        $this->resources[$model][] = compact('key', 'fetch', 'ttl');
    }

    public function forModel(string $model): array
    {
        return $this->resources[$model] ?? [];
    }
}
