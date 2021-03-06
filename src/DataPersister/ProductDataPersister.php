<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class ProductDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    private $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager,
                                CategoryRepository $categoryRepository)
    {
        $this->entityManager = $entityManager;
        $this -> categoryRepository = $categoryRepository;

    }


    /**
     * @param Product $data
     * @param array $context
     * @throws Exception
     */
    public function persist($data, array $context = [])
    {
        $dateTimeZone = new DateTimeZone('Europe/Paris');
        try {
            $data->setUpdatedAt(new DateTime('now', $dateTimeZone));
        } catch (\Exception $e) {
        }
        $this -> entityManager -> persist($data);
        $this -> entityManager -> flush();
    }


    public function supports($data, array $context = []): bool
    {
        return $data instanceof Product;
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}