<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiagnosticRequest;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\Api\DiagnosticResource;
use App\Http\Resources\Api\PatientResource;
use App\Models\Patient;
use Core\BoundedContext\Patient\Application\UpdateUseCase;
use Core\BoundedContext\Patient\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;

class UpdatePatientController extends Controller
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
     * @param PatientRequest $request
     * @param Patient $patient
     * @return JsonResponse
     */
   public function __invoke(PatientRequest $request, Patient $patient): JsonResponse
   {
       $response = (new UpdateUseCase($this->repository))->__invoke(
           ...(['id' => $patient->id] + $request->validated())
       );

       return response()->json([
           'message' => 'Patient created successfully',
           'data' => new PatientResource($response),
       ]);
   }
}
