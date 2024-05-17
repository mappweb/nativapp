<?php

namespace Core\BoundedContext\Patient\Domain\ValueObjects;

class PatientIdVO
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
