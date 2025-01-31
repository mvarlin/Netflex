<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'playlist')]
    private ?PlaylistMedia $playlistMedia = null;

    #[ORM\ManyToOne(inversedBy: 'playlist')]
    private ?User $author = null;

    /**
     * @var Collection<int, PlaylistSubscription>
     */
    #[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'playlist')]
    private Collection $playlistSubscriber;

    public function __construct()
    {
        $this->playlistSubscriber = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPlaylistMedia(): ?PlaylistMedia
    {
        return $this->playlistMedia;
    }

    public function setPlaylistMedia(?PlaylistMedia $playlistMedia): static
    {
        $this->playlistMedia = $playlistMedia;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSubscription>
     */
    public function getPlaylistSubscriber(): Collection
    {
        return $this->playlistSubscriber;
    }

    public function addPlaylistSubscriber(PlaylistSubscription $playlistSubscriber): static
    {
        if (!$this->playlistSubscriber->contains($playlistSubscriber)) {
            $this->playlistSubscriber->add($playlistSubscriber);
            $playlistSubscriber->setPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistSubscriber(PlaylistSubscription $playlistSubscriber): static
    {
        if ($this->playlistSubscriber->removeElement($playlistSubscriber)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscriber->getPlaylist() === $this) {
                $playlistSubscriber->setPlaylist(null);
            }
        }

        return $this;
    }
}
