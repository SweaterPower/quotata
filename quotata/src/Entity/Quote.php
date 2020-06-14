<?php

namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuoteRepository::class)
 */
class Quote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="quotes")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=FriendsGroup::class, inversedBy="quotes")
     */
    private $friendGroup;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $image = [];

    /**
     * @ORM\OneToMany(targetEntity=Phrase::class, mappedBy="quote")
     */
    private $phrases;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="quote")
     */
    private $comments;

    public function __construct()
    {
        $this->phrases = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getFriendGroup(): ?FriendsGroup
    {
        return $this->friendGroup;
    }

    public function setFriendGroup(?FriendsGroup $friendGroup): self
    {
        $this->friendGroup = $friendGroup;

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

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?array
    {
        return $this->image;
    }

    public function setImage(?array $image): self
    {
        $this->image = $image;

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
            $phrase->setQuote($this);
        }

        return $this;
    }

    public function removePhrase(Phrase $phrase): self
    {
        if ($this->phrases->contains($phrase)) {
            $this->phrases->removeElement($phrase);
            // set the owning side to null (unless already changed)
            if ($phrase->getQuote() === $this) {
                $phrase->setQuote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setQuote($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getQuote() === $this) {
                $comment->setQuote(null);
            }
        }

        return $this;
    }
}
