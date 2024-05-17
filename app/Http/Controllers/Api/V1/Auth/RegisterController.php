<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\JsonResponse;
use Core\BoundedContext\User\Application\StoreUseCase;
use Core\BoundedContext\User\Infrastructure\EloquentUserRepository;

class RegisterController extends Controller
{
    /**
     * @var EloquentUserRepository
     */
    private EloquentUserRepository $repository;

    /**
     * @param EloquentUserRepository $repository
     */
    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle a login request to the application.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function __invoke(UserRequest $request): JsonResponse
    {
        $user = (new StoreUseCase($this->repository))->__invoke(
            ...$request->only(['firstName', 'lastName', 'email', 'password'])
        );

        return response()->json([
            'message' => 'User created successfully',
            'user' => new UserResource($user),
        ]);
    }
}
