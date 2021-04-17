<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Comment;
use App\Entity\Product;
use App\Repository\CommentRepository;
use App\Repository\ProductRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class CommentDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    private $commentRepository;

    public function __construct(EntityManagerInterface $entityManager,
                                CommentRepository $commentRepository)
    {
        $this->entityManager = $entityManager;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param Comment $data
     * @param array $context
     * @throws Exception
     */
    public function persist($data, array $context = [])
    {
        $dateTimeZone = new DateTimeZone('Europe/Paris');
        try {
            if ($data->getCreatedAt() == null) {
                $data->setCreatedAt(new DateTime('now', $dateTimeZone));
            }
        } catch (\Exception $e) {
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Comment;
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}