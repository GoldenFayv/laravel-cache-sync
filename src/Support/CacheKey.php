<?php

namespace Goldenfavour\CacheSync\Support;

class CacheKey
{
    public function __construct(protected string $key) {}

    public static function make(string $key): self
    {
        return new self($key);
    }

    public function value(): string
    {
        return $this->key;
    }

    public function __toString(): string
    {
        return $this->key;
    }
}