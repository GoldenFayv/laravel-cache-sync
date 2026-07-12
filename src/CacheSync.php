<?php

namespace Goldenfavour\CacheSync;

use Closure;
use Goldenfavour\CacheSync\Operations\RememberOperation;
use Goldenfavour\CacheSync\Operations\SyncOperation;

class CacheSync
{
    public function __construct(protected RememberOperation $rememberOp, protected SyncOperation $syncOp) {}

    public function resource(string $key): CacheBuilder
    {
        return new CacheBuilder($key, $this->rememberOp, $this->syncOp);
    }
 
    public function remember(string $key, Closure $fetch, mixed $ttl = null): mixed
    {
        return $this->resource($key)->ttl($ttl)->remember($fetch);
        // return $this->runner->remember($key, $fetch, $ttl);
    }

    // CacheSync.php
    public function sync(string $key, callable $action, callable $fetch, mixed $ttl = null): mixed
    {
        return $this->resource($key)->ttl($ttl)->sync($action, $fetch);
        // return $this->runner->sync($key, $action, $fetch, $ttl);
    }
}
