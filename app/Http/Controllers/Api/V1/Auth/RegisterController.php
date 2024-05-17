<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validator = $this->requestValidate($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 423);
        }

        $user = (new StoreUseCase($this->repository))->__invoke(
            ...$request->only(['firstName', 'lastName', 'email', 'password'])
        );

        return response()->json([
            'message' => 'User created successfully',
            'user' => new UserResource($user),
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    private function requestValidate(Request $request)
    {
        return Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'passwordConfirmation' => ['required', 'string', 'min:8', 'same:password'],
        ]);
    }
}
