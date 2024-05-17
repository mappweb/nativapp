<?php

namespace Core\BoundedContext\Patient\Application;

use Core\BoundedContext\Patient\Domain\Patient;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientContact;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientName;
use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;
use Core\BoundedContext\Patient\Domain\Contracts\PatientRepository;

class StoreUseCase
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
     * @param $birthday
     * @param $email
     * @param $phone
     * @param $genre
     * @return Patient
     */
    public function __invoke(
        $document,
        $firstName,
        $lastName,
        $birthday,
        $email,
        $phone,
        $genre,
    ): Patient
    {
        $document = new StringVO($document);
        $name = new PatientName(
            new StringVO($firstName),
            new StringVO($lastName),
        );
        $birthday = new StringVO($birthday);
        $contact = new PatientContact(
            new StringVO($email),
            new StringVO($phone),
        );
        $genre = new StringVO($genre);
        $patient = Patient::create(null, $document, $name, $birthday, $contact, $genre);

        return $this->repository->store($patient);
    }
}
