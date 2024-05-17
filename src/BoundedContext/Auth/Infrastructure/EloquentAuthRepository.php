<?php

namespace Core\BoundedContext\Auth\Infrastructure;

use Core\BoundedContext\Auth\Domain\Auth as AuthAlias;
use Core\BoundedContext\Auth\Domain\Contracts\AuthRepository;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthEmailVO;
use Core\BoundedContext\Auth\Domain\ValueObjects\AuthPasswordVO;
use Core\BoundedContext\User\Domain\User;
use Core\BoundedContext\User\Domain\ValueObjects\UserEmailVO;
use Core\BoundedContext\User\Domain\ValueObjects\UserIdVO;
use Core\BoundedContext\User\Domain\ValueObjects\StringVO;
use DomainException;
use Illuminate\Support\Facades\Auth;

class EloquentAuthRepository implements AuthRepository
{
    /**
     * @param AuthEmailVO $email
     * @param AuthPasswordVO $password
     * @return AuthAlias
     */
    public function login(AuthEmailVO $email, AuthPasswordVO $password): \Core\BoundedContext\Auth\Domain\Auth
    {
        if (!Auth::attempt(['email' => $email->value(), 'password' => $password->value()])) {
            throw new DomainException('Unauthorized', 401);
        }
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();

        return new AuthAlias(
            User::create(
                new UserIdVO($user->id),
                new StringVO($user->first_name),
                new StringVO($user->last_name),
                new UserEmailVO($user->email)
            ),
            $user->createToken('TokenApi')->plainTextToken
        );
    }


    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }
}
