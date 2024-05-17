<?php

namespace Core\BoundedContext\Patient\Application;

use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;
use Core\BoundedContext\Patient\Domain\Contracts\PatientRepository;
use Core\BoundedContext\Patient\Domain\Patient;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientContact;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientIdVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientName;

class UpdateUseCase
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
        $id,
        $document,
        $firstName,
        $lastName,
        $birthday,
        $email,
        $phone,
        $genre,
    ): Patient
    {
        $id = new PatientIdVO($id);
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
        $patient = Patient::create($id, $document, $name, $birthday, $contact, $genre);

        return $this->repository->update($patient);
    }
}
