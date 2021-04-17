<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use App\Repository\CommentRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * /**
 * @ApiResource(
 * itemOperations={
 *         "get",
 *         "put",
 *         "delete",
 *         "patch"
 *     },
 * collectionOperations={
 *     "get",
 *     "post",
 *     "comments_by_product"={{
 *         "route_name"="comments_by_product",
 *     "swagger_context" = {
 *     "parameters" = {
 *     "name" = "id",
 *     "in" = "path",
 *     "required" = "true",
 *     "type" = "integer"
 *     }}
 *     },
 *          "method"="GET" },
 *         "comments_by_product",
 *     },
 *     normalizationContext={"groups"={"read"},"enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}})
 *
 *
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Groups({"read", "write"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read", "write"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $rate;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $productId;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $userId;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }




    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }


}
