<?php

namespace Core\BoundedContext\User\Infrastructure;

use App\Models\User as EloquentUserModel;
use Core\BoundedContext\User\Domain\Auth as AuthAlias;
use Core\BoundedContext\User\Domain\Contracts\UserRepository;
use Core\BoundedContext\User\Domain\User;
use Core\BoundedContext\User\Domain\ValueObjects\UserEmailVO;
use Core\BoundedContext\User\Domain\ValueObjects\UserIdVO;
use Core\BoundedContext\User\Domain\ValueObjects\StringVO;
use Illuminate\Support\Facades\Hash;

/**
 * @property \App\Models\User $eloquentUserModel
 */
class EloquentUserRepository implements UserRepository
{
    /**
     * @var EloquentUserModel
     */
    private EloquentUserModel $eloquentUserModel;

    /**
     * Instance constructor.
     */
    public function __construct()
    {
        $this->eloquentUserModel = new EloquentUserModel();
    }

    /**
     * @param User $user
     * @return User
     */
    public function store(User $user): User
    {
        $user = $this->eloquentUserModel->query()
            ->updateOrCreate([
                'first_name' => $user->firstName()->value(),
                'last_name' => $user->lastName()->value(),
                'email' => $user->email()->value(),
                'password' => Hash::make($user->password()->value()),
            ]);

        $id = new UserIdVO($user->id);
        $firstName = new StringVO($user->first_name);
        $lastName = new StringVO($user->last_name);
        $email = new UserEmailVO($user->email);

        return User::create($id, $firstName, $lastName, $email, null);
    }
}
