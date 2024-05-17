<?php

namespace Core\BoundedContext\Diagnostic\Domain\ValueObjects;

class DiagnosticIdVO
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
