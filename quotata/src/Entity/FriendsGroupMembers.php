<?php

namespace App\Entity;

use App\Repository\FriendsGroupMembersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FriendsGroupMembersRepository::class)
 */
class FriendsGroupMembers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="friendsGroupMembers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupUser;

    /**
     * @ORM\ManyToOne(targetEntity=FriendsGroup::class, inversedBy="friendsGroupMembers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $friendsGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupUser(): ?User
    {
        return $this->groupUser;
    }

    public function setGroupUser(?User $groupUser): self
    {
        $this->groupUser = $groupUser;

        return $this;
    }

    public function getFriendsGroup(): ?FriendsGroup
    {
        return $this->friendsGroup;
    }

    public function setFriendsGroup(?FriendsGroup $friendsGroup): self
    {
        $this->friendsGroup = $friendsGroup;

        return $this;
    }
}
