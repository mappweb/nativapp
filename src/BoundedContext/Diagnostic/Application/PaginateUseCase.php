<?php

namespace Core\BoundedContext\Diagnostic\Application;

use Core\BoundedContext\Diagnostic\Domain\Contracts\DiagnosticRepository;
use Core\BoundedContext\Diagnostic\Domain\Diagnostic;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\IntegerVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\StringVO;

class PaginateUseCase
{
    /**
     * @var DiagnosticRepository
     */
    private DiagnosticRepository $repository;

    /**
     * @param DiagnosticRepository $repository
     */
    public function __construct(DiagnosticRepository $repository)
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
