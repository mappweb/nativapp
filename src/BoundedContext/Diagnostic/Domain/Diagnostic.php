<?php

namespace Core\BoundedContext\Diagnostic\Domain;

use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\StringVO;

class Diagnostic
{
    private ?DiagnosticIdVO $id;
    private StringVO $name;
    private StringVO $description;

    public function __construct(
        ?DiagnosticIdVO            $id,
        StringVO             $name,
        StringVO             $description,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return ?DiagnosticIdVO
     */
    public function id(): ?DiagnosticIdVO
    {
        return $this->id;
    }

    /**
     * @return StringVO
     */
    public function name(): StringVO
    {
        return $this->name;
    }

    /**
     * @return StringVO|null
     */
    public function description(): ?StringVO
    {
        return $this->description;
    }

    /**
     * @param DiagnosticIdVO|null $id
     * @param StringVO $firstName
     * @param StringVO|null $lastName
     * @return self
     */
    public static function create(
        ?DiagnosticIdVO            $id,
        StringVO             $firstName,
        ?StringVO             $lastName = null,
    )
    {
        return new self($id, $firstName, $lastName);
    }

}
