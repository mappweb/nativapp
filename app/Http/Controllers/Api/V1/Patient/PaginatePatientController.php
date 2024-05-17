<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Api\PatientPaginateResource;
use App\Traits\PaginateJsonResponse;
use Core\BoundedContext\Patient\Application\PaginateUseCase;
use Core\BoundedContext\Patient\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;

class PaginatePatientController extends Controller
{
    use PaginateJsonResponse;

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
     * Display a listing of challenges.
     *
     * @param PaginateRequest $request
     * @return JsonResponse
     */
   public function __invoke(PaginateRequest $request): JsonResponse
   {
       $response = (new PaginateUseCase($this->repository))->__invoke(
           ...(['perPage' => $request->get('perPage', 10), 'page' => $request->get('page', 1)])
       );

       return response()->json([
           'message' => 'Patients lists successfully',
           'data' => $this->paginate($response, PatientPaginateResource::class),
       ]);
   }
}
