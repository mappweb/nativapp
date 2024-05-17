<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DiagnosticResource;
use App\Http\Resources\Api\PatientResource;
use App\Models\Diagnostic;
use App\Models\Patient;
use Core\BoundedContext\Patient\Application\DestroyUseCase;
use Core\BoundedContext\Patient\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class DestroyPatientController extends Controller
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
     * @param Patient $patient
     * @return JsonResponse
     */
    public function __invoke(Request $request, Patient $patient): JsonResponse
    {
        try {
            $response = (new DestroyUseCase($this->repository))->__invoke(
                ...(['id' => $patient->id])
            );
        } catch (Throwable $exception) {

            return response()->json([
                'message' => 'Patient could not be eliminated',
            ]);
        }

        return response()->json([
            'message' => 'Patient deleted successfully',
            'data' => new PatientResource($response),
        ]);
    }
}
