<?php

namespace Core\BoundedContext\Patient\Application;

use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;
use Core\BoundedContext\Patient\Domain\Contracts\PatientRepository;
use Core\BoundedContext\Patient\Domain\Patient;

class SearchUseCase
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
     * @param $document
     * @param $firstName
     * @param $lastName
     * @return Patient
     */
    public function __invoke(
        $document,
        $firstName,
        $lastName
    ): Patient
    {
        $document = new StringVO($document);
        $firstName = new StringVO($firstName);
        $lastName = new StringVO($lastName);

        return $this->repository->search($document, $firstName, $lastName);
    }
}
