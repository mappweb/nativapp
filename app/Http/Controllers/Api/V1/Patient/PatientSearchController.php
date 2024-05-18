<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientSearchRequest;
use App\Http\Resources\Api\PatientResource;
use Core\BoundedContext\Patient\Application\SearchUseCase;
use Core\BoundedContext\Patient\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;

class PatientSearchController extends Controller
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
     * @param PatientSearchRequest $request
     * @return JsonResponse
     */
   public function __invoke(PatientSearchRequest $request): JsonResponse
   {
       $response = (new SearchUseCase($this->repository))->__invoke(
           ...($request->validated())
       );

       return response()->json([
           'message' => 'Patient created successfully',
           'data' => new PatientResource($response),
       ]);
   }
}
