<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ApplicationSenderDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'application_sender_details')]
#[ORM\Entity(repositoryClass: ApplicationSenderDetailsRepository::class)]
#[ORM\UniqueConstraint(name: 'UC_SENDER_PHONE_NUMBER', fields: ['phoneNumber'])]
class ApplicationSenderDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(length: 32)]
    private ?string $phoneNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
