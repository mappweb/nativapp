<?php

namespace Core\BoundedContext\User\Domain;

use Core\BoundedContext\User\Domain\ValueObjects\UserEmailVO;
use Core\BoundedContext\User\Domain\ValueObjects\UserIdVO;
use Core\BoundedContext\User\Domain\ValueObjects\UserPasswordVO;
use Core\BoundedContext\User\Domain\ValueObjects\StringVO;

class User
{
    private ?UserIdVO $id;
    private StringVO $firstName;
    private StringVO $lastName;
    private UserEmailVO $email;
    private ?UserPasswordVO $password;

    public function __construct(
        ?UserIdVO            $id,
        StringVO             $firstName,
        StringVO             $lastName,
        UserEmailVO          $email,
        ?UserPasswordVO $password = null
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return UserIdVO
     */
    public function id(): UserIdVO
    {
        return $this->id;
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

    /**
     * @return UserEmailVO
     */
    public function email(): UserEmailVO
    {
        return $this->email;
    }

    /**
     * @return UserPasswordVO|null
     */
    public function password(): ?UserPasswordVO
    {
        return $this->password;
    }

    public static function create(
        ?UserIdVO            $id,
        StringVO             $firstName,
        StringVO             $lastName,
        UserEmailVO          $email,
        ?UserPasswordVO $password = null
    )
    {
        return new self($id, $firstName, $lastName, $email, $password);
    }

}
