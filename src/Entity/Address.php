<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"read"},"enable_max_depth"=true},
 * denormalizationContext={"groups"={"write"}}
 * )
 * * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column (type = "string", nullable=false, length=20)
     * @Groups({"read", "write"})
     */
    private $street;

    /**
     * @ORM\Column (type = "string", nullable=false, length=20)
     * @Groups({"read", "write"})
     */
    private $postalCode;

    /**
     * @ORM\Column (type = "string", nullable=false, length=20)
     * @Groups({"read", "write"})
     */
    private $city;

    /**
     * @ORM\Column (type = "string", nullable=false, length=20)
     * @Groups({"read", "write"})
     */
    private $country;

    public function getId(): int
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }


}
