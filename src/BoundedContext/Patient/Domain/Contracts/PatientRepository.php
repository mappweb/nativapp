<?php

namespace Core\BoundedContext\Patient\Domain\Contracts;

use Core\BoundedContext\Patient\Domain\ValueObjects\IntegerVO;
use Core\BoundedContext\Patient\Domain\Patient;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientIdVO;

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
}
