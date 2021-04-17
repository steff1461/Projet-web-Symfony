<?php


namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    /**
     *
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @param $id
     * @return Response
     * @Route(
     *     name="comments_by_product",
     *     path="/api/comments/product/{id}",
     *     methods={"GET"},
     *     defaults={
     *         "api_resource_class"=Comment::class,
     *         "api_item_operation_name"="comments_by_product"
     *     }
     *     )
     */
    public function findAllByProduct(CommentRepository $commentRepository, Request $request, $id): Response
    {


        $comments = $commentRepository->findAllByProduct($id);
        $data = $this->get('serializer')->serialize($comments, 'json');
        $response = new Response($data);
        $response->headers->set('Content-type', 'application/json');
        return $response;
    }
}