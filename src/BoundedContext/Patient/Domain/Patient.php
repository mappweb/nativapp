<?php

namespace Core\BoundedContext\Patient\Domain;

use Core\BoundedContext\Patient\Domain\ValueObjects\StringVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientContact;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientIdVO;
use Core\BoundedContext\Patient\Domain\ValueObjects\PatientName;

class Patient
{

    private ?PatientIdVO $id;
    private PatientName $name;
    private StringVO $birthday;
    private PatientContact $contact;
    private StringVO $genre;
    private StringVO $document;

    public function __construct(
        ?PatientIdVO $id,
        StringVO        $document,
        PatientName     $name,
        StringVO        $birthday,
        PatientContact  $contact,
        StringVO        $genre,
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->contact = $contact;
        $this->genre = $genre;
        $this->document = $document;
    }

    /**
     * @return ?PatientIdVO
     */
    public function id(): ?PatientIdVO
    {
        return $this->id;
    }

    /**
     * @return StringVO
     */
    public function document(): StringVO
    {
        return $this->document;
    }

    /**
     * @return PatientName
     */
    public function name(): PatientName
    {
        return $this->name;
    }

    /**
     * @return StringVO
     */
    public function birthday(): StringVO
    {
        return $this->birthday;
    }

    /**
     * @return PatientContact
     */
    public function contact(): PatientContact
    {
        return $this->contact;
    }

    /**
     * @return StringVO
     */
    public function genre(): StringVO
    {
        return $this->genre;
    }

    /**
     * @param PatientIdVO|null $id
     * @param StringVO $document
     * @param PatientName $name
     * @param StringVO $birthday
     * @param PatientContact $contact
     * @param StringVO $genre
     * @return self
     */
    public static function create(
        ?PatientIdVO $id,
        StringVO        $document,
        PatientName     $name,
        StringVO        $birthday,
        PatientContact  $contact,
        StringVO        $genre,
    )
    {
        return new self($id, $document, $name, $birthday, $contact, $genre);
    }

}
