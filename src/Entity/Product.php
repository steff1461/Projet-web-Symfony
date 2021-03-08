<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 *
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 *
 */
class Product
{
    public function __construct()
    {
        $dateTimeZone = new DateTimeZone('Europe/Paris');
        $this->createdAt = new DateTime('now', $dateTimeZone);
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read", "write"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @Groups({"read", "write"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;


    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): Product
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): Product
    {
        $this->description = $description;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): Product
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
