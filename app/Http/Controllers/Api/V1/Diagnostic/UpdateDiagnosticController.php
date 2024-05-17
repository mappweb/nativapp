<?php

namespace App\Http\Controllers\Api\V1\Diagnostic;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiagnosticRequest;
use App\Http\Resources\Api\DiagnosticResource;
use Core\BoundedContext\Diagnostic\Application\UpdateUseCase;
use Core\BoundedContext\Diagnostic\Domain\Diagnostic;
use Core\BoundedContext\Diagnostic\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;

class UpdateDiagnosticController extends Controller
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
     * Update the specified challenge in storage.
     *
     * @param DiagnosticRequest $request
     * @param $diagnosticId
     * @return JsonResponse
     */
   public function __invoke(DiagnosticRequest $request, $diagnosticId): JsonResponse
   {
       $response = (new UpdateUseCase($this->repository))->__invoke(
           ...(['id' => $diagnosticId] + $request->only(['name', 'description']))
       );

       return response()->json([
           'message' => 'Diagnostic created successfully',
           'data' => new DiagnosticResource($response),
       ]);
   }
}
