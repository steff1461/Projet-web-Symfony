<?php

namespace App\Entity;

use App\Repository\UserRepository;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 *  * @ApiResource(
 *     itemOperations={
 *         "get",
 *         "put",
 *         "delete",
 *         "patch",
 *         "user_by_username" = {{
 *         "route_name": "user_by_username"
 *
 *      },
 *         "method"="GET" },
 *     },
 * collectionOperations={
 *     "get",
 *     "post"
 *     },
 *     normalizationContext={"groups"={"read"},"enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true,nullable=false)
     * @Groups({"read", "write"})
     */
    private $email;

    /**
     * @ORM\Column(type="json",nullable=false)
     * @Groups("read")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string",nullable=false, length=20)
     * @Groups("write")
     */
    private $password;

    /**
     * @Groups("write")
     * @SerializedName ("password")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read", "write"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read", "write"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=20,unique=true,nullable=false)
     * @Groups({"read", "write"})
     */
    private $username;

    /**
     * @ORM\Column(type="integer",unique= true)
     * @Groups({"read", "write"})
     */
    private $addressId;

    public function __construct()
    {
        $this->purchasings = new ArrayCollection();
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
        return (string)$this->username;
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

    public function getStringId(): string
    {

        return $this->getId();
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
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

    public function getAddressId()
    {
        return $this->addressId;
    }

    public function setAddressId($addressId): void
    {
        $this->addressId = $addressId;
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
