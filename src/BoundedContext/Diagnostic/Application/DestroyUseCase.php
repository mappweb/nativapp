<?php

namespace Core\BoundedContext\Diagnostic\Application;

use Core\BoundedContext\Diagnostic\Domain\Contracts\DiagnosticRepository;
use Core\BoundedContext\Diagnostic\Domain\Diagnostic;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\StringVO;

class DestroyUseCase
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
     * @param $id
     * @param $name
     * @param $description
     * @return Diagnostic
     */
    public function __invoke($id): Diagnostic
    {
        $id = new DiagnosticIdVO($id);

        return $this->repository->destroy($id);
    }
}
