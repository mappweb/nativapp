<?php

namespace Core\BoundedContext\Patient\Infrastructure;

use App\Models\Patient as EloquentModel;
use Core\BoundedContext\Patient\Domain\Contracts\PatientRepository;
use Core\BoundedContext\Patient\Domain\Patient;
use Core\BoundedContext\Patient\Domain\ValueObjects\IntegerVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientContact;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientIdVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientName;
use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;

/**
 * @property \App\Models\User $eloquentUserModel
 */
class EloquentDiagnosticRepository implements PatientRepository
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
     * @param Patient $patient
     * @return Patient
     */
    public function store(Patient $patient): Patient
    {
        $patient = $this->eloquentModel->query()
            ->updateOrCreate([
                'document' => $patient->document()->value(),
                'first_name' => $patient->name()->firstName()->value(),
                'last_name' => $patient->name()->lastName()->value(),
                'birthday' => $patient->birthday()->value(),
                'email' => $patient->contact()->email()->value(),
                'phone' => $patient->contact()->phone()->value(),
                'genre' => $patient->genre()->value(),
            ]);

        $id = new PatientIdVO($patient->id);
        $document = new StringVO($patient->document);
        $name = new PatientName(
            new StringVO($patient->first_name),
            new StringVO($patient->last_name),
        );
        $birthday = new StringVO($patient->birthday);
        $contact = new PatientContact(
            new StringVO($patient->email),
            new StringVO($patient->phone),
        );
        $genre = new StringVO($patient->genre);

        return Patient::create($id, $document, $name, $birthday, $contact, $genre);
    }

    /**
     * @param Patient $patient
     * @return Patient
     */
    public function update(Patient $patient): Patient
    {
        $patient = $this->eloquentModel->query()
            ->updateOrCreate(
                [
                    'id' => $patient->id()->value(),
                ],
                [
                    'document' => $patient->document()->value(),
                    'first_name' => $patient->name()->firstName()->value(),
                    'last_name' => $patient->name()->lastName()->value(),
                    'birthday' => $patient->birthday()->value(),
                    'email' => $patient->contact()->email()->value(),
                    'phone' => $patient->contact()->phone()->value(),
                    'genre' => $patient->genre()->value(),
                ]
            );

        $id = new PatientIdVO($patient->id);
        $document = new StringVO($patient->document);
        $name = new PatientName(
            new StringVO($patient->first_name),
            new StringVO($patient->last_name),
        );
        $birthday = new StringVO($patient->birthday);
        $contact = new PatientContact(
            new StringVO($patient->email),
            new StringVO($patient->phone),
        );
        $genre = new StringVO($patient->genre);

        return Patient::create($id, $document, $name, $birthday, $contact, $genre);
    }

    /**
     * @param PatientIdVO $id
     * @return Patient
     */
    public function destroy(PatientIdVO $id): Patient
    {
        $patient = $this->eloquentModel->query()
            ->findOrFail($id->value());

        $patient->delete();

        $id = new PatientIdVO($patient->id);
        $document = new StringVO($patient->document);
        $name = new PatientName(
            new StringVO($patient->first_name),
            new StringVO($patient->last_name),
        );
        $birthday = new StringVO($patient->birthday);
        $contact = new PatientContact(
            new StringVO($patient->email),
            new StringVO($patient->phone),
        );
        $genre = new StringVO($patient->genre);

        return Patient::create($id, $document, $name, $birthday, $contact, $genre);
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
