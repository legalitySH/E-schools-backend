<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EducationalApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'applications')]
#[ORM\Entity(repositoryClass: EducationalApplicationRepository::class)]
class EducationalApplication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Director::class, cascade: ['remove'])]
    #[ORM\JoinColumn(name: 'director_id', referencedColumnName: 'id')]
    private Director $director;

    #[ORM\OneToOne(targetEntity: ApplicationSenderDetails::class, cascade: ['remove'])]
    #[ORM\JoinColumn(name: 'sender_id', referencedColumnName: 'id')]
    private ApplicationSenderDetails $sender;

    #[ORM\OneToOne(targetEntity: EducationalInstitution::class, cascade: ['remove'])]
    #[ORM\JoinColumn(name: 'educational_id', referencedColumnName: 'id')]
    private EducationalInstitution $institution;
    #[ORM\Column]
    private ?bool $isApproved = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDirector(): Director
    {
        return $this->director;
    }

    public function setDirector(Director $director): static
    {
        $this->director = $director;

        return $this;
    }

    public function getSender(): ApplicationSenderDetails
    {
        return $this->sender;
    }

    public function setSender(ApplicationSenderDetails $sender): static
    {
        $this->sender = $sender;

        return $this;
    }

    public function getInstitution(): EducationalInstitution
    {
        return $this->institution;
    }

    public function setInstitution(EducationalInstitution $institution): static
    {
        $this->institution = $institution;

        return $this;
    }

    public function getIsApproved(): ?bool
    {
        return $this->isApproved;
    }

    public function setIsApproved(bool $isApproved): static
    {
        $this->isApproved = $isApproved;

        return $this;
    }
}
