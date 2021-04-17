<?php

namespace App\EventListener;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;


class AuthenticationSuccessListener
{
    private $userRepository ;

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this -> userRepository = $entityManager -> getRepository(User::class);
    }
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }
        $userFromDB =  $this -> userRepository -> findUserByUsername($user ->getUsername());


        $data['data'] = array(
            'userId' => $userFromDB->getId(),
            'firstname' => $userFromDB -> getFirstname(),
            'lastname' => $userFromDB -> getLastname()
        );

        $event->setData($data);
    }
}