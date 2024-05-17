<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Core\BoundedContext\Auth\Application\LogoutUseCase;
use Core\BoundedContext\Auth\Infrastructure\EloquentAuthRepository;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
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
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $logoutUseCase = new LogoutUseCase($this->repository);
        $logoutUseCase->__invoke();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
