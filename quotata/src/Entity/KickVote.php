<?php

namespace App\Entity;

use App\Repository\KickVoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KickVoteRepository::class)
 */
class KickVote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="kickVotes")
     */
    private $userToKick;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="kickVotes")
     */
    private $voter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserToKick(): ?User
    {
        return $this->userToKick;
    }

    public function setUserToKick(?User $userToKick): self
    {
        $this->userToKick = $userToKick;

        return $this;
    }

    public function getVoter(): ?User
    {
        return $this->voter;
    }

    public function setVoter(?User $voter): self
    {
        $this->voter = $voter;

        return $this;
    }
}
