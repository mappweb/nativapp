<?php

namespace Core\BoundedContext\Auth\Domain;

use Core\BoundedContext\User\Domain\User;

class Auth
{
    private User $user;
    private string $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function token(): string
    {
        return $this->token;
    }

    public function type(): string
    {
        return 'bearer';
    }

    public static function create(User $user, string $token)
    {
        return new self($user, $token);
    }
}
