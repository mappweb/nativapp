<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\Api\DiagnosticResource;
use App\Http\Resources\Api\PatientResource;
use Core\BoundedContext\Patient\Application\StoreUseCase;
use Core\BoundedContext\Patient\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreatePatientController extends Controller
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
     * @param PatientRequest $request
     * @return JsonResponse
     */
   public function __invoke(PatientRequest $request): JsonResponse
   {
       $diagnostic = (new StoreUseCase($this->repository))->__invoke(
           ...$request->validated()
       );

       return response()->json([
           'message' => 'Patient created successfully',
           'data' => new PatientResource($diagnostic),
       ]);
   }
}
