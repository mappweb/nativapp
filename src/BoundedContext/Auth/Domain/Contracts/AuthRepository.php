<?php

namespace Core\BoundedContext\Auth\Domain\Contracts;

use Core\BoundedContext\Auth\Domain\Auth;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthEmailVO;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthPasswordVO;


interface AuthRepository
{
    /**
     * @param AuthEmailVO $email
     * @param AuthPasswordVO $password
     * @return Auth
     */
    public function login(AuthEmailVO $email, AuthPasswordVO $password): Auth;

    /**
     * @return void
     */
    public function logout(): void;
}
