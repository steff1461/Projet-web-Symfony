<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Exception;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use App\Repository\ProductRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ApiResource(
 * attributes={"pagination_items_per_page"=10},
 * itemOperations={
 *         "get",
 *         "put",
 *         "delete",
 *         "patch",
 *         "products_count" = {{
 *          "route_name": "products_count"
 *
 *     },
 *     "method"="GET"
 *     },
 *     },
 * collectionOperations={
 *     "get",
 *     "post"={"security"="is_granted('ROLE_ADMIN')"},
 *     "products_by_cat"={{
 *         "route_name"="products_by_category",
 *     "swagger_context" = {
 *     "parameters" = {
 *     "name" = "id",
 *     "in" = "path",
 *     "required" = "true",
 *     "type" = "integer"
 *     }}
 *     },
 *          "method"="GET" },
 *         "products_by_category",
 *     },
 *
 *     normalizationContext={"groups"={"read"},"enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}})
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    public function __construct()
    {
        $dateTimeZone = new DateTimeZone('Europe/Paris');
        try {
            $this->createdAt = new DateTime('now', $dateTimeZone);
        } catch (Exception $e) {
        }
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Groups({"read", "write"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=50,nullable=false)
     * @Groups({"read", "write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20,nullable=false)
     * @Groups({"read", "write"})
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private $updatedAt;

    /**
     * @var MediaObject|null
     *
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read", "write"})
     */
    public $image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class,cascade={"persist"})
     * @Groups({"read", "write"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="integer" , nullable = true)
     * @Groups({"read", "write"})
     */
    private $rating;


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

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return MediaObject|null
     */
    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    /**
     * @param MediaObject|null $image
     */
    public function setImage(?MediaObject $image): void
    {
        $this->image = $image;
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

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }
}
