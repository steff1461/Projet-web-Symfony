<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use DateTimeZone;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\PurchasingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PurchasingRepository::class)
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
 *     "purchasings_by_user"={{
 *         "route_name"="purchasings_by_user",
 *     "swagger_context" = {
 *     "parameters" = {
 *     "name" = "id",
 *     "in" = "path",
 *     "required" = "true",
 *     "type" = "integer"
 *     }}
 *     },
 *          "method"="GET" },
 *         "purchasings_by_user",
 *     },
 *     normalizationContext={"groups"={"read"},"enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}})
 */
class Purchasing
{

    public function __construct()
    {
        $this->productsId = new Array_();
        $dateTimeZone = new DateTimeZone('Europe/Paris');
        try {
            $this->createdAt = new DateTime('now', $dateTimeZone);
        } catch (\Exception $e) {
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
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private $createdAt;


    /**
     * @var array
     * @ORM\Column(name="products", type="array", length=15)
     * @Groups({"read", "write"})
     */
    private $productsId;

    /**
     * @ORM\Column (type = "integer", nullable=false)
     * @Groups({"read", "write"})
     */
    private $userId;


    public function getId()
    {
        return $this->id;
    }


    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return array
     */
    public function getProductsId(): array
    {
        return $this->productsId;
    }

    /**
     * @param array $productsId
     */
    public function setProductsId(array $productsId): void
    {
        $this->productsId = $productsId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}
