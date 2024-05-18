<?php

namespace Core\BoundedContext\Patient\Domain\Contracts;

use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\IntegerVO;
use Core\BoundedContext\Patient\Domain\Patient;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientIdVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;

interface PatientRepository
{
    /**
     * @param Patient $patient
     * @return Patient
     */
    public function store(Patient $patient): Patient;

    /**
     * @param Patient $patient
     * @return Patient
     */
    public function update(Patient $patient): Patient;

    /**
     * @param PatientIdVO $id
     * @return Patient
     */
    public function destroy(PatientIdVO $id): Patient;

    /**
     * @param IntegerVO|null $perPage
     * @param IntegerVO|null $page
     * @return mixed
     */
    public function paginate(?IntegerVO $perPage, ?IntegerVO $page): mixed;

    /**
     * @param PatientIdVO $patientId
     * @param DiagnosticIdVO $diagnosticId
     * @param StringVO|null $observation
     * @return void
     */
    public function attachDiagnostic(PatientIdVO $patientId, DiagnosticIdVO $diagnosticId, ?StringVO $observation= null): void;

    /**
     * @param StringVO|null $document
     * @param StringVO|null $firstName
     * @param StringVO|null $lastName
     * @return mixed
     */
    public function search(?StringVO $document, ?StringVO $firstName, ?StringVO $lastName): Patient;
}
