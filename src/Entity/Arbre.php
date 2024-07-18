<?php

namespace App\Entity;

use App\Repository\ArbreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArbreRepository::class)]
class Arbre
{
    #[ORM\Id]
    //#[ORM\GeneratedValue]
    #[ORM\Column(name: 'numArbre')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateImplantation = null;

    #[ORM\Column]
    private ?bool $aRisque = null;

    #[ORM\ManyToOne(inversedBy: 'arbres')]
    private ?Parc $parc = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id):static
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

    public function getDateImplantation(): ?\DateTimeInterface
    {
        return $this->dateImplantation;
    }

    public function setDateImplantation(\DateTimeInterface $dateImplantation): static
    {
        $this->dateImplantation = $dateImplantation;

        return $this;
    }

    public function isARisque(): ?bool
    {
        return $this->aRisque;
    }

    public function setARisque(bool $aRisque): static
    {
        $this->aRisque = $aRisque;

        return $this;
    }

    public function getParc(): ?Parc
    {
        return $this->parc;
    }

    public function setParc(?Parc $parc): static
    {
        $this->parc = $parc;

        return $this;
    }
}
