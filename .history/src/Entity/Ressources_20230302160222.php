<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RessourcesRepository::class)]
#[ApiResource]


class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Positive]
    #[Assert\LessThan(200)]
    private ?float $montant = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'ressources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partenaire $partenaires = null;


    public function __construct()
    {
        $this->createdAt= new \DateTimeImmutable;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPartenaires(): ?Partenaire
    {
        return $this->partenaires;
    }

    public function setPartenaires(?Partenaire $partenaires): self
    {
        $this->partenaires = $partenaires;

        return $this;
    }
}
