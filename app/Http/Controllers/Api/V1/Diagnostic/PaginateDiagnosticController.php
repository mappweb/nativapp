<?php

namespace App\Http\Controllers\Api\V1\Diagnostic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DiagnosticPaginateResource;
use App\Traits\PaginateJsonResponse;
use Core\BoundedContext\Diagnostic\Application\PaginateUseCase;
use Core\BoundedContext\Diagnostic\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaginateDiagnosticController extends Controller
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
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request): JsonResponse
   {
       $response = (new PaginateUseCase($this->repository))->__invoke(
           ...(['perPage' => $request->get('perPage', 10), 'page' => $request->get('page', 1)])
       );

       return response()->json([
           'message' => 'Diagnostics lists successfully',
           'data' => $this->paginate($response, DiagnosticPaginateResource::class),
       ]);
   }
}
