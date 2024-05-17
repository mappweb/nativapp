<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use Core\BoundedContext\Auth\Application\LoginUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Core\BoundedContext\Auth\Infrastructure\EloquentAuthRepository;

class LoginController extends Controller
{
    private EloquentAuthRepository $repository;

    /**
     * @param EloquentAuthRepository $repository
     */
    public function __construct(EloquentAuthRepository $repository)
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

        $auth = (new LoginUseCase($this->repository))->__invoke(...$request->only(['email', 'password']));

        return response()->json([
            'user' => new UserResource($auth->user()),
            'authorization' => [
                'token' => $auth->token(),
                'type' => $auth->type(),
            ]
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    private function requestValidate(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    private function username(): string
    {
        return 'email';
    }
}
