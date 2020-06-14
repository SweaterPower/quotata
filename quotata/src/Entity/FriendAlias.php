<?php

namespace App\Entity;

use App\Repository\FriendAliasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FriendAliasRepository::class)
 */
class FriendAlias
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="friendAliases")
     */
    private $owner;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $friend;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Phrase::class, mappedBy="friendAlias")
     */
    private $phrases;

    public function __construct()
    {
        $this->phrases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getFriend(): ?User
    {
        return $this->friend;
    }

    public function setFriend(?User $friend): self
    {
        $this->friend = $friend;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Phrase[]
     */
    public function getPhrases(): Collection
    {
        return $this->phrases;
    }

    public function addPhrase(Phrase $phrase): self
    {
        if (!$this->phrases->contains($phrase)) {
            $this->phrases[] = $phrase;
            $phrase->setFriendAlias($this);
        }

        return $this;
    }

    public function removePhrase(Phrase $phrase): self
    {
        if ($this->phrases->contains($phrase)) {
            $this->phrases->removeElement($phrase);
            // set the owning side to null (unless already changed)
            if ($phrase->getFriendAlias() === $this) {
                $phrase->setFriendAlias(null);
            }
        }

        return $this;
    }
}
