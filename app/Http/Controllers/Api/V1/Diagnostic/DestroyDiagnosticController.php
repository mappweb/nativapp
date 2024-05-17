<?php

namespace App\Http\Controllers\Api\V1\Diagnostic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DiagnosticResource;
use App\Models\Diagnostic;
use Core\BoundedContext\Diagnostic\Application\DestroyUseCase;
use Core\BoundedContext\Diagnostic\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class DestroyDiagnosticController extends Controller
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
     * Remove the specified challenge from storage.
     *
     * @param Request $request
     * @param Diagnostic $diagnostic
     * @return JsonResponse
     */
    public function __invoke(Request $request, Diagnostic $diagnostic): JsonResponse
    {
        try {
            $response = (new DestroyUseCase($this->repository))->__invoke(
                ...(['id' => $diagnostic->id])
            );
        } catch (Throwable $exception) {

            return response()->json([
                'message' => 'Diagnostic could not be eliminated',
            ]);
        }

        return response()->json([
            'message' => 'Diagnostic deleted successfully',
            'data' => new DiagnosticResource($response),
        ]);
    }
}
