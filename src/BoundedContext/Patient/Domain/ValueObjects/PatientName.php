<?php

namespace Core\BoundedContext\Patient\Domain\ValueObjects;

use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;

class PatientName
{
    private StringVO $firstName;
    private StringVO $lastName;

    public function __construct(
        StringVO             $firstName,
        StringVO             $lastName,
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return StringVO
     */
    public function firstName(): StringVO
    {
        return $this->firstName;
    }

    /**
     * @return StringVO
     */
    public function lastName(): StringVO
    {
        return $this->lastName;
    }
}
