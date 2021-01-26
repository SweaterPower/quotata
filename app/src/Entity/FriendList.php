<?php

namespace App\Entity;

use App\Repository\FriendListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FriendListRepository::class)
 */
class FriendList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="friendLists")
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="friendList")
     */
    private $friend;

    public function __construct()
    {
        $this->friend = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getFriend(): Collection
    {
        return $this->friend;
    }

    public function addFriend(User $friend): self
    {
        if (!$this->friend->contains($friend)) {
            $this->friend[] = $friend;
        }

        return $this;
    }

    public function removeFriend(User $friend): self
    {
        if ($this->friend->contains($friend)) {
            $this->friend->removeElement($friend);
            }

        return $this;
    }
}
