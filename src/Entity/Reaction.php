<?php

namespace App\Entity;

use App\Repository\ReactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReactionRepository::class)]
class Reaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeReact = null;

    #[ORM\Column]
    private ?\DateTime $dateReact = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $idUser = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    private ?Publication $idPub = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTypeReact(): ?string
    {
        return $this->typeReact;
    }

    public function setTypeReact(string $typeReact): static
    {
        $this->typeReact = $typeReact;

        return $this;
    }

    public function getDateReact(): ?\DateTime
    {
        return $this->dateReact;
    }

    public function setDateReact(\DateTime $dateReact): static
    {
        $this->dateReact = $dateReact;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdPub(): ?Publication
    {
        return $this->idPub;
    }

    public function setIdPub(?Publication $idPub): static
    {
        $this->idPub = $idPub;

        return $this;
    }
}
