<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Patient;
use Core\BoundedContext\Patient\Application\AttachDiagnosticUseCase;
use Core\BoundedContext\Patient\Infrastructure\EloquentDiagnosticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientAttachDiagnosticController extends Controller
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
     * @param Patient $patient
     * @param Diagnostic $diagnostic
     * @return JsonResponse
     */
   public function __invoke(Request $request, Patient $patient, Diagnostic $diagnostic): JsonResponse
   {
       (new AttachDiagnosticUseCase($this->repository))->__invoke(
           ...([
               'patientId' => $patient->id,
               'diagnosticId' => $diagnostic->id,
               'observation' => $request->get('observation')
           ])
       );

       return response()->json([
           'message' => 'Diagnostic attach successfully',
       ]);
   }
}
