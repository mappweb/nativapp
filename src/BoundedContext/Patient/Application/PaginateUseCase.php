<?php

namespace Core\BoundedContext\Patient\Application;

use Core\BoundedContext\Patient\Domain\ValueObjects\IntegerVO;
use Core\BoundedContext\Patient\Domain\Contracts\PatientRepository;

class PaginateUseCase
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
     * @param $perPage
     * @param $page
     * @return mixed
     */
    public function __invoke($perPage, $page): mixed
    {
        $perPage = new IntegerVO($perPage);
        $page = new IntegerVO($page);

        return $this->repository->paginate($perPage, $page);
    }
}
