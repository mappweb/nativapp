<?php

namespace App\Http\Controllers\Api\V1\Diagnostic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DiagnosticResource;
use Core\BoundedContext\Diagnostic\Application\StoreUseCase;
use Core\BoundedContext\Diagnostic\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateDiagnosticController extends Controller
{
    /**
     * @var EloquentDiagnosticRepository
     */
    private EloquentDiagnosticRepository $repository;

    /**
     * Instance Constructor.
     *
     * @param EloquentDiagnosticRepository $repository
     */
    public function __construct(EloquentDiagnosticRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created challenge in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request): JsonResponse
   {
       $diagnostic = (new StoreUseCase($this->repository))->__invoke(
           ...$request->only(['name', 'description'])
       );

       return response()->json([
           'message' => 'Diagnostic created successfully',
           'data' => new DiagnosticResource($diagnostic),
       ]);
   }
}
