<?php

namespace Core\BoundedContext\Auth\Application;

use Core\BoundedContext\Auth\Domain\Contracts\AuthRepository;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthEmailVO;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthPasswordVO;

class LogoutUseCase
{
    private AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): void
    {
        $this->repository->logout();
    }
}
