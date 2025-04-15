<?php

namespace App\Entity;

use App\Repository\PlaylistMediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistMediaRepository::class)]
class PlaylistMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistMedia')]
    private ?Playlist $playlistId = null;

    #[ORM\ManyToOne(inversedBy: 'playlistMedia')]
    private ?Media $mediaId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $addedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistId(): ?Playlist
    {
        return $this->playlistId;
    }

    public function setPlaylistId(?Playlist $playlistId): static
    {
        $this->playlistId = $playlistId;

        return $this;
    }

    public function getMediaId(): ?Media
    {
        return $this->mediaId;
    }

    public function setMediaId(?Media $mediaId): static
    {
        $this->mediaId = $mediaId;

        return $this;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): static
    {
        $this->addedAt = $addedAt;

        return $this;
    }
}
