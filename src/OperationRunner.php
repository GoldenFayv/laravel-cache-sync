<?php

namespace Goldenfavour\CacheSync;

use Goldenfavour\CacheSync\Operations\RememberOperation;
use Goldenfavour\CacheSync\Operations\SyncOperation;
use Goldenfavour\CacheSync\Support\CacheKey;
use Illuminate\Support\Facades\DB;

class OperationRunner
{
    public function __construct(protected RememberOperation $remember, protected SyncOperation $sync) {}

    public function remember(CacheKey|string $key, callable $fetch, mixed $ttl = null): mixed
    {
        return $this->remember->handle($key, $fetch, $ttl);
    }

    public function sync(string $key, callable $action, callable $fetch, mixed $ttl = null): mixed
    {
        return DB::transaction(function () use ($action, $fetch, $key, $ttl) {
            return $this->sync->handle($key, $action, $fetch, $ttl);
        });
    }
}
