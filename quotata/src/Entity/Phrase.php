<?php

namespace App\Entity;

use App\Repository\PhraseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhraseRepository::class)
 */
class Phrase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Quote::class, inversedBy="phrases")
     */
    private $quote;

    /**
     * @ORM\ManyToOne(targetEntity=FriendAlias::class, inversedBy="phrases")
     */
    private $friendAlias;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(?Quote $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getFriendAlias(): ?FriendAlias
    {
        return $this->friendAlias;
    }

    public function setFriendAlias(?FriendAlias $friendAlias): self
    {
        $this->friendAlias = $friendAlias;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
