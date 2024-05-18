<?php

namespace Core\BoundedContext\Patient\Application;

use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientIdVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;
use Core\BoundedContext\Patient\Domain\Contracts\PatientRepository;

class AttachDiagnosticUseCase
{
    /**
     * @var PatientRepository
     */
    private PatientRepository $repository;

    /**
     * @param PatientRepository $repository
     */
    public function __construct(PatientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $patientId
     * @param $diagnosticId
     * @param $observation
     * @return void
     */
    public function __invoke(
        $patientId,
        $diagnosticId,
        $observation = null
    ): void
    {
        $patientId = new PatientIdVO($patientId);
        $diagnosticId = new DiagnosticIdVO($diagnosticId);
        $observation = !empty($observation) ? (new StringVO($observation)) : null;

        $this->repository->attachDiagnostic($patientId, $diagnosticId, $observation);
    }
}
