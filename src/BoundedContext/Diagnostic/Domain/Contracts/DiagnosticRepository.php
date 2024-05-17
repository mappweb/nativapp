<?php

namespace Core\BoundedContext\Diagnostic\Domain\Contracts;

use Core\BoundedContext\Diagnostic\Domain\Diagnostic;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\IntegerVO;

interface DiagnosticRepository
{
    /**
     * @param Diagnostic $diagnostic
     * @return Diagnostic
     */
    public function store(Diagnostic $diagnostic): Diagnostic;

    /**
     * @param Diagnostic $diagnostic
     * @return Diagnostic
     */
    public function update(Diagnostic $diagnostic): Diagnostic;

    /**
     * @param DiagnosticIdVO $id
     * @return Diagnostic
     */
    public function destroy(DiagnosticIdVO $id): Diagnostic;

    /**
     * @param IntegerVO|null $perPage
     * @param IntegerVO|null $page
     * @return mixed
     */
    public function paginate(?IntegerVO $perPage, ?IntegerVO $page): mixed;
}
