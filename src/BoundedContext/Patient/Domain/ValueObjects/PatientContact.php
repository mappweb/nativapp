<?php

namespace Core\BoundedContext\Patient\Domain\ValueObjects;

use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;

class PatientContact
{
    private StringVO $email;
    private StringVO $phone;

    public function __construct(
        StringVO             $email,
        StringVO             $phone
    )
    {
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return StringVO
     */
    public function email(): StringVO
    {
        return $this->email;
    }

    /**
     * @return StringVO
     */
    public function phone(): StringVO
    {
        return $this->phone;
    }
}
