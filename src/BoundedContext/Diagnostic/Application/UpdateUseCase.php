<?php

namespace Core\BoundedContext\Diagnostic\Application;

use Core\BoundedContext\Diagnostic\Domain\Contracts\DiagnosticRepository;
use Core\BoundedContext\Diagnostic\Domain\Diagnostic;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\StringVO;

class UpdateUseCase
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
    public function __invoke($id, $name, $description = null): Diagnostic
    {
        $id = new DiagnosticIdVO($id);
        $name = new StringVO($name);
        $description = new StringVO($description);
        $diagnostic = Diagnostic::create($id, $name, $description);

        return $this->repository->update($diagnostic);
    }
}
