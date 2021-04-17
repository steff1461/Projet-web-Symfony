<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     *
     * @param UserRepository $userRepository
     * @param Request $request
     * @param $username
     * @return Response
     * @Route (
     *     name="user_by_username",
     *     path="/api/users/current/{username}",
     *     methods={"GET"},
     *     defaults={
     *         "api_resource_class"=User::class,
     *         "api_item_operation_name"="user_by_username"
     *     }
     *     )
     */
    public function findUserByUsername(UserRepository $userRepository, Request $request, $username): Response
    {
        $user = $userRepository->findUserByUsername($username);
        $data = $this->get('serializer')->serialize($user, 'json');
        $response = new Response($data);
        $response->headers->set('Content-type', 'application/json');
        return $response;
    }
}