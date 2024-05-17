<?php

namespace Core\BoundedContext\Diagnostic\Application;

use Core\BoundedContext\Diagnostic\Domain\Contracts\DiagnosticRepository;
use Core\BoundedContext\Diagnostic\Domain\Diagnostic;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\StringVO;

class StoreUseCase
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
     * @param $name
     * @param $description
     * @return Diagnostic
     */
    public function __invoke($name, $description = null): Diagnostic
    {
        $name = new StringVO($name);
        $description = new StringVO($description);

        $diagnostic = Diagnostic::create(null, $name, $description);

        return $this->repository->store($diagnostic);
    }
}
