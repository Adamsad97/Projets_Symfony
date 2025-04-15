<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'seasons')]
    private ?self $serieId = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'serieId')]
    private Collection $seasons;

    #[ORM\Column(length: 255)]
    private ?string $seasonNumber = null;

    /**
     * @var Collection<int, Episode>
     */
    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: 'seasonId')]
    private Collection $episodes;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getSerieId(): ?self
    {
        return $this->serieId;
    }

    public function setSerieId(?self $serieId): static
    {
        $this->serieId = $serieId;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(self $season): static
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons->add($season);
            $season->setSerieId($this);
        }

        return $this;
    }

    public function removeSeason(self $season): static
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getSerieId() === $this) {
                $season->setSerieId(null);
            }
        }

        return $this;
    }

    public function getSeasonNumber(): ?string
    {
        return $this->seasonNumber;
    }

    public function setSeasonNumber(string $seasonNumber): static
    {
        $this->seasonNumber = $seasonNumber;

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): static
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes->add($episode);
            $episode->setSeasonId($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): static
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getSeasonId() === $this) {
                $episode->setSeasonId(null);
            }
        }

        return $this;
    }
}
