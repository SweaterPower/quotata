<?php

namespace App\Entity;

use App\Repository\FriendsGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FriendsGroupRepository::class)
 */
class FriendsGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\OneToMany(targetEntity=FriendsGroupMembers::class, mappedBy="friendsGroup")
     */
    private $friendsGroupMembers;

    /**
     * @ORM\OneToMany(targetEntity=Quote::class, mappedBy="friendGroup")
     */
    private $quotes;

    public function __construct()
    {
        $this->friendsGroupMembers = new ArrayCollection();
        $this->quotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return Collection|FriendsGroupMembers[]
     */
    public function getFriendsGroupMembers(): Collection
    {
        return $this->friendsGroupMembers;
    }

    public function addFriendsGroupMember(FriendsGroupMembers $friendsGroupMember): self
    {
        if (!$this->friendsGroupMembers->contains($friendsGroupMember)) {
            $this->friendsGroupMembers[] = $friendsGroupMember;
            $friendsGroupMember->setFriendsGroup($this);
        }

        return $this;
    }

    public function removeFriendsGroupMember(FriendsGroupMembers $friendsGroupMember): self
    {
        if ($this->friendsGroupMembers->contains($friendsGroupMember)) {
            $this->friendsGroupMembers->removeElement($friendsGroupMember);
            // set the owning side to null (unless already changed)
            if ($friendsGroupMember->getFriendsGroup() === $this) {
                $friendsGroupMember->setFriendsGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Quote[]
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes[] = $quote;
            $quote->setFriendGroup($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->contains($quote)) {
            $this->quotes->removeElement($quote);
            // set the owning side to null (unless already changed)
            if ($quote->getFriendGroup() === $this) {
                $quote->setFriendGroup(null);
            }
        }

        return $this;
    }
}
