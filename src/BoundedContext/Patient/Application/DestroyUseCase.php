<?php

namespace Core\BoundedContext\Patient\Application;

use Core\BoundedContext\Patient\Domain\Contracts\PatientRepository;
use Core\BoundedContext\Patient\Domain\Patient;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientIdVO;

class DestroyUseCase
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
     * @param $id
     * @return Patient
     */
    public function __invoke($id): Patient
    {
        $id = new PatientIdVO($id);

        return $this->repository->destroy($id);
    }
}
