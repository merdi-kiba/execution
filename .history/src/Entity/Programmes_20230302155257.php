<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProgrammesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProgrammesRepository::class)]
#[ApiResource]

class Programmes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'programmes')]
    private ?self $programmes = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    private ?Entite $entite = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    private ?EntrepriseExecu $entrepriseExecu = null;

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgrammes(): ?self
    {
        return $this->programmes;
    }

    public function setProgrammes(?self $programmes): self
    {
        $this->programmes = $programmes;

        return $this;
    }

    public function addProgramme(self $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes->add($programme);
            $programme->setProgrammes($this);
        }

        return $this;
    }

    public function removeProgramme(self $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getProgrammes() === $this) {
                $programme->setProgrammes(null);
            }
        }

        return $this;
    }

    public function getEntite(): ?Entite
    {
        return $this->entite;
    }

    public function setEntite(?Entite $entite): self
    {
        $this->entite = $entite;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEntrepriseExecu(): ?EntrepriseExecu
    {
        return $this->entrepriseExecu;
    }

    public function setEntrepriseExecu(?EntrepriseExecu $entrepriseExecu): self
    {
        $this->entrepriseExecu = $entrepriseExecu;

        return $this;
    }
}
