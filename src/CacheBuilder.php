<?php

namespace Goldenfavour\CacheSync;

use Closure;
use Goldenfavour\CacheSync\Operations\RememberOperation;
use Goldenfavour\CacheSync\Operations\SyncOperation;

class CacheBuilder
{
    protected mixed $ttl = null;

    public function __construct(protected string $key, protected RememberOperation $remember, protected SyncOperation $sync,) {}
    
    public function ttl(mixed $ttl): self
    {
        $this->ttl = $ttl;

        return $this;
    }

    public function remember(Closure $fetch): mixed
    {
        return $this->remember->handle($this->key, $fetch, $this->ttl);
    }

    public function sync(Closure $action, Closure $fetch): mixed
    {
        return $this->sync->handle($this->key, $action, $fetch, $this->ttl);
    }
}
