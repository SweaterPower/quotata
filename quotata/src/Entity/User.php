<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $secondName;

    /**
     * @ORM\OneToMany(targetEntity=FriendsGroupMembers::class, mappedBy="groupUser")
     */
    private $friendsGroupMembers;

    /**
     * @ORM\OneToMany(targetEntity=FriendRequest::class, mappedBy="acceptingUser")
     */
    private $friendRequests;

    /**
     * @ORM\OneToMany(targetEntity=FriendRequest::class, mappedBy="friend")
     */
    private $sentFriendRequests;

    /**
     * @ORM\OneToMany(targetEntity=FriendList::class, mappedBy="owner")
     */
    private $friendLists;

    /**
     * @ORM\OneToMany(targetEntity=FriendAlias::class, mappedBy="owner")
     */
    private $friendAliases;

    /**
     * @ORM\OneToMany(targetEntity=Quote::class, mappedBy="author")
     */
    private $quotes;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="author")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=KickVote::class, mappedBy="userToKick")
     */
    private $votesToKick;

    /**
     * @ORM\OneToMany(targetEntity=KickVote::class, mappedBy="voter")
     */
    private $kickVotes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function __construct()
    {
        $this->friendsGroupMembers = new ArrayCollection();
        $this->friendRequests = new ArrayCollection();
        $this->sentFriendRequests = new ArrayCollection();
        $this->friendLists = new ArrayCollection();
        $this->friendAliases = new ArrayCollection();
        $this->quotes = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->votesToKick = new ArrayCollection();
        $this->kickVotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): self
    {
        $this->secondName = $secondName;

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
            $friendsGroupMember->setGroupUser($this);
        }

        return $this;
    }

    public function removeFriendsGroupMember(FriendsGroupMembers $friendsGroupMember): self
    {
        if ($this->friendsGroupMembers->contains($friendsGroupMember)) {
            $this->friendsGroupMembers->removeElement($friendsGroupMember);
            // set the owning side to null (unless already changed)
            if ($friendsGroupMember->getGroupUser() === $this) {
                $friendsGroupMember->setGroupUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FriendRequest[]
     */
    public function getFriendRequests(): Collection
    {
        return $this->friendRequests;
    }

    public function addFriendRequest(FriendRequest $friendRequest): self
    {
        if (!$this->friendRequests->contains($friendRequest)) {
            $this->friendRequests[] = $friendRequest;
            $friendRequest->setAcceptingUser($this);
        }

        return $this;
    }

    public function removeFriendRequest(FriendRequest $friendRequest): self
    {
        if ($this->friendRequests->contains($friendRequest)) {
            $this->friendRequests->removeElement($friendRequest);
            // set the owning side to null (unless already changed)
            if ($friendRequest->getAcceptingUser() === $this) {
                $friendRequest->setAcceptingUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FriendRequest[]
     */
    public function getSentFriendRequests(): Collection
    {
        return $this->sentFriendRequests;
    }

    public function addSentFriendRequest(FriendRequest $sentFriendRequest): self
    {
        if (!$this->sentFriendRequests->contains($sentFriendRequest)) {
            $this->sentFriendRequests[] = $sentFriendRequest;
            $sentFriendRequest->setFriend($this);
        }

        return $this;
    }

    public function removeSentFriendRequest(FriendRequest $sentFriendRequest): self
    {
        if ($this->sentFriendRequests->contains($sentFriendRequest)) {
            $this->sentFriendRequests->removeElement($sentFriendRequest);
            // set the owning side to null (unless already changed)
            if ($sentFriendRequest->getFriend() === $this) {
                $sentFriendRequest->setFriend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FriendList[]
     */
    public function getFriendLists(): Collection
    {
        return $this->friendLists;
    }

    public function addFriendList(FriendList $friendList): self
    {
        if (!$this->friendLists->contains($friendList)) {
            $this->friendLists[] = $friendList;
            $friendList->setOwner($this);
        }

        return $this;
    }

    public function removeFriendList(FriendList $friendList): self
    {
        if ($this->friendLists->contains($friendList)) {
            $this->friendLists->removeElement($friendList);
            // set the owning side to null (unless already changed)
            if ($friendList->getOwner() === $this) {
                $friendList->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FriendAlias[]
     */
    public function getFriendAliases(): Collection
    {
        return $this->friendAliases;
    }

    public function addFriendAlias(FriendAlias $friendAlias): self
    {
        if (!$this->friendAliases->contains($friendAlias)) {
            $this->friendAliases[] = $friendAlias;
            $friendAlias->setOwner($this);
        }

        return $this;
    }

    public function removeFriendAlias(FriendAlias $friendAlias): self
    {
        if ($this->friendAliases->contains($friendAlias)) {
            $this->friendAliases->removeElement($friendAlias);
            // set the owning side to null (unless already changed)
            if ($friendAlias->getOwner() === $this) {
                $friendAlias->setOwner(null);
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
            $quote->setAuthor($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->contains($quote)) {
            $this->quotes->removeElement($quote);
            // set the owning side to null (unless already changed)
            if ($quote->getAuthor() === $this) {
                $quote->setAuthor(null);
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
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|KickVote[]
     */
    public function getvotesToKick(): Collection
    {
        return $this->votesToKick;
    }

    public function addKickVote(KickVote $kickVote): self
    {
        if (!$this->votesToKick->contains($kickVote)) {
            $this->votesToKick[] = $kickVote;
            $kickVote->setUserToKick($this);
        }

        return $this;
    }

    public function removeKickVote(KickVote $kickVote): self
    {
        if ($this->votesToKick->contains($kickVote)) {
            $this->votesToKick->removeElement($kickVote);
            // set the owning side to null (unless already changed)
            if ($kickVote->getUserToKick() === $this) {
                $kickVote->setUserToKick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|KickVote[]
     */
    public function getKickVotes(): Collection
    {
        return $this->kickVotes;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
