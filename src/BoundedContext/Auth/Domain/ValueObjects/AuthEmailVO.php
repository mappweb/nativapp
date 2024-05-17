<?php

namespace Core\BoundedContext\Auth\Domain\ValueObjects;

class AuthEmailVO
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
