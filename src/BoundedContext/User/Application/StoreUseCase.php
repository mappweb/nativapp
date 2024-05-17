<?php

namespace Core\BoundedContext\User\Application;

use Core\BoundedContext\User\Domain\Contracts\UserRepository;
use Core\BoundedContext\User\Domain\User;
use Core\BoundedContext\User\Domain\ValueObjects\UserEmailVO;
use Core\BoundedContext\User\Domain\ValueObjects\UserPasswordVO;
use Core\BoundedContext\User\Domain\ValueObjects\StringVO;

class StoreUseCase
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     * @return User
     */
    public function __invoke($firstName, $lastName, $email, $password): User
    {
        $firstName = new StringVO($firstName);
        $lastName = new StringVO($lastName);
        $email = new UserEmailVO($email);
        $password = new UserPasswordVO($password);

        $user = User::create(null, $firstName, $lastName, $email, $password);

        return $this->repository->store($user);
    }
}
