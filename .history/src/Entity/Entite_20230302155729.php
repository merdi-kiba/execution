<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EntiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EntiteRepository::class)]
#[ApiResource]
class Entite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'entites')]
    private ?self $entite = null;

    #[ORM\OneToMany(mappedBy: 'entite', targetEntity: self::class)]
    private Collection $entites;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min:2, max:50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'entite', targetEntity: Programmes::class)]
    private Collection $programmes;

    public function __construct()
    {
        $this->entites = new ArrayCollection();
        $this->programmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntite(): ?self
    {
        return $this->entite;
    }

    public function setEntite(?self $entite): self
    {
        $this->entite = $entite;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEntites(): Collection
    {
        return $this->entites;
    }

    public function addEntite(self $entite): self
    {
        if (!$this->entites->contains($entite)) {
            $this->entites->add($entite);
            $entite->setEntite($this);
        }

        return $this;
    }

    public function removeEntite(self $entite): self
    {
        if ($this->entites->removeElement($entite)) {
            // set the owning side to null (unless already changed)
            if ($entite->getEntite() === $this) {
                $entite->setEntite(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Programmes>
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programmes $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes->add($programme);
            $programme->setEntite($this);
        }

        return $this;
    }

    public function removeProgramme(Programmes $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getEntite() === $this) {
                $programme->setEntite(null);
            }
        }

        return $this;
    }
}
