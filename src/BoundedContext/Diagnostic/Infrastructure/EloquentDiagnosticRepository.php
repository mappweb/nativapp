<?php

namespace Core\BoundedContext\Diagnostic\Infrastructure;

use App\Models\Diagnostic as EloquentModel;
use Core\BoundedContext\Diagnostic\Domain\Contracts\DiagnosticRepository;
use Core\BoundedContext\Diagnostic\Domain\Diagnostic;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\DiagnosticIdVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\IntegerVO;
use Core\BoundedContext\Diagnostic\Domain\ValueObjects\StringVO;

/**
 * @property \App\Models\User $eloquentUserModel
 */
class EloquentDiagnosticRepository implements DiagnosticRepository
{
    /**
     * @var EloquentModel
     */
    private EloquentModel $eloquentModel;

    /**
     * Instance constructor.
     */
    public function __construct()
    {
        $this->eloquentModel = new EloquentModel();
    }

    /**
     * @param Diagnostic $diagnostic
     * @return Diagnostic
     */
    public function store(Diagnostic $diagnostic): Diagnostic
    {
        $diagnostic = $this->eloquentModel->query()
            ->updateOrCreate([
                'name' => $diagnostic->name()->value(),
                'description' => $diagnostic->description()->value(),
            ]);

        $id = new DiagnosticIdVO($diagnostic->id);
        $name = new StringVO($diagnostic->name);
        $description = new StringVO($diagnostic->description);

        return Diagnostic::create($id, $name, $description);
    }

    /**
     * @param Diagnostic $diagnostic
     * @return Diagnostic
     */
    public function update(Diagnostic $diagnostic): Diagnostic
    {
        $diagnostic = $this->eloquentModel->query()
            ->updateOrCreate(
                [
                    'id' => $diagnostic->id()->value(),
                ],
                [
                    'name' => $diagnostic->name()->value(),
                    'description' => $diagnostic->description()->value()
                ]
            );

        $id = new DiagnosticIdVO($diagnostic->id);
        $name = new StringVO($diagnostic->name);
        $description = new StringVO($diagnostic->description);

        return Diagnostic::create($id, $name, $description);
    }

    /**
     * @param DiagnosticIdVO $id
     * @return Diagnostic
     */
    public function destroy(DiagnosticIdVO $id): Diagnostic
    {
        $diagnostic = $this->eloquentModel->query()
            ->findOrFail($id->value());

        $diagnostic->delete();

        $id = new DiagnosticIdVO($diagnostic->id);
        $name = new StringVO($diagnostic->name);
        $description = new StringVO($diagnostic->description);

        return Diagnostic::create($id, $name, $description);
    }

    /**
     * @param IntegerVO|null $perPage
     * @param IntegerVO|null $page
     * @return mixed
     */
    public function paginate(?IntegerVO $perPage, ?IntegerVO $page): mixed
    {
        return $this->eloquentModel->query()
            ->paginate(
                $perPage->value() ?? 10,
                ['*'],
                'page',
                $page->value() ?? 1,
            );
    }
}
