<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use JMS\Serializer\Annotation as Serializer;

class Address
{
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('company')]
    protected ?string $company = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('street')]
    protected ?string $street = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('houseNumber')]
    protected ?string $houseNumber = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('line2')]
    protected ?string $line2 = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('line3')]
    protected ?string $line3 = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('city')]
    protected string $city = '';

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('zip')]
    protected ?string $zip = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('state')]
    protected ?string $state = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('country')]
    protected string $country = '';

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('countryCode')]
    protected string $countryCode = '';

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('firstName')]
    protected ?string $firstName = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('lastName')]
    protected ?string $lastName = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('id')]
    protected ?string $id = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('phone')]
    protected ?string $phone = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('eMail')]
    protected ?string $email = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('Addition')]
    protected ?string $nameAddition = null;

    #[Serializer\Type('enum<'.AddressSalutationEnum::class.'>')]
    #[Serializer\SerializedName('salutationId')]
    protected AddressSalutationEnum $salutationId = AddressSalutationEnum::Undefined;

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): Address
    {
        $this->company = $company;
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(?string $houseNumber): Address
    {
        $this->houseNumber = $houseNumber;
        return $this;
    }

    public function getLine2(): ?string
    {
        return $this->line2;
    }

    public function setLine2(?string $line2): Address
    {
        $this->line2 = $line2;
        return $this;
    }

    public function getLine3(): ?string
    {
        return $this->line3;
    }

    public function setLine3(?string $line3): Address
    {
        $this->line3 = $line3;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): Address
    {
        $this->zip = $zip;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): Address
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): Address
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): Address
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Address
    {
        $this->id = $id;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): Address
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): Address
    {
        $this->email = $email;
        return $this;
    }

    public function getNameAddition(): ?string
    {
        return $this->nameAddition;
    }

    public function setNameAddition(?string $nameAddition): Address
    {
        $this->nameAddition = $nameAddition;
        return $this;
    }

    public function getSalutationId(): AddressSalutationEnum
    {
        return $this->salutationId;
    }

    public function setSalutationId(AddressSalutationEnum $salutationId): Address
    {
        $this->salutationId = $salutationId;
        return $this;
    }
}
