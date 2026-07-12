<?php

namespace Goldenfavour\CacheSync\Resources;

use Closure;

class CacheResource
{
    public function __construct(protected string $key, protected ?string $model = null, protected ?Closure $fetch = null, protected mixed $ttl = null, protected array $tags = []) {}

    public static function make(string $key): static
    {
        return new static($key);
    }

    public function model(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function fetch(Closure $fetch): static
    {
        $this->fetch = $fetch;

        return $this;
    }

    public function ttl(mixed $ttl): static
    {
        $this->ttl = $ttl;

        return $this;
    }

    public function tags(array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function modelClass(): ?string
    {
        return $this->model;
    }

    public function fetchCallback(): ?Closure
    {
        return $this->fetch;
    }

    public function ttlValue(): mixed
    {
        return $this->ttl;
    }

    public function tagsList(): array
    {
        return $this->tags;
    }
}
