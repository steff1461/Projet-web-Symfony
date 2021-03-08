<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class ProductDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this -> logger = $logger;

    }


    /**
     * @param Product $data
     * @param array $context
     * @throws Exception
     */
    public function persist($data, array $context = [])
    {
        $data -> setName("fuze");
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