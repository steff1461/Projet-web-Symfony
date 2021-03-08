<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *  * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read", "write"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("read")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups("read")
     */
    private $password;

    /**
     * @Groups("write")
     * @SerializedName ("password")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Purchasing::class, mappedBy="user", orphanRemoval=true)
     * @Groups({"read", "write"})
     */
    private $purchasings;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user")
     * @Groups({"read", "write"})
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Groups({"read", "write"})
     */
    private $username;

    public function __construct()
    {
        $this->purchasings = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Purchasing[]
     */
    public function getPurchasings(): Collection
    {
        return $this->purchasings;
    }

    public function addPurchasing(Purchasing $purchasing): self
    {
        if (!$this->purchasings->contains($purchasing)) {
            $this->purchasings[] = $purchasing;
            $purchasing->setUser($this);
        }

        return $this;
    }

    public function removePurchasing(Purchasing $purchasing): self
    {
        if ($this->purchasings->removeElement($purchasing)) {
            // set the owning side to null (unless already changed)
            if ($purchasing->getUser() === $this) {
                $purchasing->setUser(null);
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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
}
