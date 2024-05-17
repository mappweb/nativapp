<?php

namespace Core\BoundedContext\Auth\Application;

use Core\BoundedContext\Auth\Domain\Contracts\AuthRepository;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthEmailVO;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthPasswordVO;

class LoginUseCase
{
    private AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($email, $password)
    {
        $email = new AuthEmailVO($email);
        $password = new AuthPasswordVO($password);

        return $this->repository->login($email, $password);
    }
}
